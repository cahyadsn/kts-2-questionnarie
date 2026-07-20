<?php
require_once __DIR__ . '/TestRunner.php';
require_once __DIR__ . '/../inc/env.php';
require_once __DIR__ . '/../inc/kts_calc.php';

TestRunner::runSuite('Environment Variables Loader', function() {
    TestRunner::test('Loads key-value pairs from file', function() {
        $tempEnvFile = __DIR__ . '/temp.env';
        file_put_contents($tempEnvFile, "TEST_KEY=test_value\n# Comment\nANOTHER_KEY=\"another value\"\n");
        
        $loaded = loadEnv($tempEnvFile);
        
        TestRunner::assertTrue($loaded, 'loadEnv should return true on successful load');
        TestRunner::assertEquals('test_value', getenv('TEST_KEY'), 'TEST_KEY should be loaded');
        TestRunner::assertEquals('another value', getenv('ANOTHER_KEY'), 'ANOTHER_KEY should be loaded and quotes stripped');
        
        // Cleanup
        if (file_exists($tempEnvFile)) {
            unlink($tempEnvFile);
        }
    });

    TestRunner::test('Handles missing file gracefully', function() {
        $loaded = loadEnv(__DIR__ . '/nonexistent.env');
        TestRunner::assertFalse($loaded, 'loadEnv should return false for nonexistent file');
    });
});

TestRunner::runSuite('KTS Score & Code Calculation', function() {
    TestRunner::test('Calculates perfect E, S, T, J type when all choices are 1 (Absolutely)', function() {
        // If all choices are 1, then:
        // E score should be 10, I score should be 0. (Since 1 corresponds to t1, 10 statements -> E=10, I=0)
        // S score should be 20, N score should be 0. (20 statements -> S=20, N=0)
        // T score should be 20, F score should be 0. (20 statements -> T=20, F=0)
        // J score should be 20, P score should be 0. (20 statements -> J=20, P=0)
        // Code should be ESTJ.
        
        $answers = array_fill(1, 70, 1);
        $result = calculateKts($answers);
        
        TestRunner::assertArrayHasKey('scores', $result);
        TestRunner::assertArrayHasKey('percentages', $result);
        TestRunner::assertArrayHasKey('code', $result);
        
        $scores = $result['scores'];
        TestRunner::assertEquals(10, $scores['E'], 'E score should be 10');
        TestRunner::assertEquals(0, $scores['I'], 'I score should be 0');
        TestRunner::assertEquals(20, $scores['S'], 'S score should be 20');
        TestRunner::assertEquals(0, $scores['N'], 'N score should be 0');
        
        TestRunner::assertEquals('ESTJ', $result['code'], 'Personality code should be ESTJ');
        TestRunner::assertEquals(100.0, $result['percentages']['E'], 'E percentage should be 100%');
        TestRunner::assertEquals(0.0, $result['percentages']['I'], 'I percentage should be 0%');
    });

    TestRunner::test('Calculates perfect I, N, F, P type when all choices are 5 (Not at All)', function() {
        // If all choices are 5, then:
        // E score should be 0, I score should be 10.
        // S score should be 0, N score should be 20.
        // T score should be 0, F score should be 20.
        // J score should be 0, P score should be 20.
        // Code should be INFP.
        
        $answers = array_fill(1, 70, 5);
        $result = calculateKts($answers);
        
        $scores = $result['scores'];
        TestRunner::assertEquals(0, $scores['E']);
        TestRunner::assertEquals(10, $scores['I']);
        TestRunner::assertEquals(0, $scores['S']);
        TestRunner::assertEquals(20, $scores['N']);
        
        TestRunner::assertEquals('INFP', $result['code'], 'Personality code should be INFP');
        TestRunner::assertEquals(0.0, $result['percentages']['E']);
        TestRunner::assertEquals(100.0, $result['percentages']['I']);
    });

    TestRunner::test('Handles middle-ground choices (3 - 50/50)', function() {
        // Option 3 counts 1 for both sides.
        // So with choice 3 for all questions:
        // E=10, I=10. S=20, N=20. T=20, F=20. J=20, P=20.
        // Since $r['E'] > $r['I'] is false (10 > 10 is false), code resolves to 'I'
        // Similarly, S/N -> 20 > 20 false -> 'N'
        // T/F -> 20 > 20 false -> 'F'
        // J/P -> 20 > 20 false -> 'P'
        // Code should be INFP.
        
        $answers = array_fill(1, 70, 3);
        $result = calculateKts($answers);
        
        $scores = $result['scores'];
        TestRunner::assertEquals(10, $scores['E']);
        TestRunner::assertEquals(10, $scores['I']);
        TestRunner::assertEquals(20, $scores['S']);
        TestRunner::assertEquals(20, $scores['N']);
        
        TestRunner::assertEquals('INFP', $result['code'], 'Personality code should be INFP');
        TestRunner::assertEquals(100.0, $result['percentages']['E']);
        TestRunner::assertEquals(100.0, $result['percentages']['I']);
    });
});

TestRunner::report();
