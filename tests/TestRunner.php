<?php
/**
 * A lightweight, zero-dependency, native PHP Unit Testing framework.
 */
class TestRunner {
    private static $passed = 0;
    private static $failed = 0;
    private static $failures = [];

    /**
     * Set up the command-line styling
     */
    private static function color($text, $colorCode) {
        // If on Windows and not in a terminal that supports ANSI, or output is redirected, might show raw codes.
        // But modern Windows terminals (like PowerShell, cmd, Laragon terminal) support ANSI colors.
        return "\033[{$colorCode}m{$text}\033[0m";
    }

    public static function runSuite($name, callable $suite) {
        echo "\n" . self::color("Running suite: $name", "1;35") . "\n";
        echo str_repeat("-", 40) . "\n";
        try {
            $suite();
        } catch (Throwable $e) {
            self::$failed++;
            self::$failures[] = [
                'suite' => $name,
                'test' => 'Suite Initialization/Execution',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
            echo self::color("FAIL: Suite crashed with error: " . $e->getMessage(), "31") . "\n";
        }
    }

    public static function test($name, callable $test) {
        echo "Testing: $name ... ";
        try {
            $test();
            self::$passed++;
            echo self::color("PASS", "32") . "\n";
        } catch (AssertionError $e) {
            self::$failed++;
            self::$failures[] = [
                'suite' => '',
                'test' => $name,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
            echo self::color("FAIL", "31") . "\n";
            echo "  " . self::color("Assertion failed: " . $e->getMessage(), "33") . "\n";
        } catch (Throwable $e) {
            self::$failed++;
            self::$failures[] = [
                'suite' => '',
                'test' => $name,
                'message' => "Uncaught exception: " . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
            echo self::color("ERROR", "31") . "\n";
            echo "  " . self::color("Exception: " . $e->getMessage(), "31") . "\n";
        }
    }

    public static function assertEquals($expected, $actual, $message = '') {
        if ($expected !== $actual) {
            $msg = $message ?: "Expected " . var_export($expected, true) . ", but got " . var_export($actual, true);
            throw new AssertionError($msg);
        }
    }

    public static function assertTrue($condition, $message = '') {
        if ($condition !== true) {
            $msg = $message ?: "Expected true, but got " . var_export($condition, true);
            throw new AssertionError($msg);
        }
    }

    public static function assertFalse($condition, $message = '') {
        if ($condition !== false) {
            $msg = $message ?: "Expected false, but got " . var_export($condition, true);
            throw new AssertionError($msg);
        }
    }

    public static function assertArrayHasKey($key, $array, $message = '') {
        if (!is_array($array) || !array_key_exists($key, $array)) {
            $msg = $message ?: "Expected array to have key '{$key}'";
            throw new AssertionError($msg);
        }
    }

    public static function report() {
        echo "\n" . str_repeat("=", 40) . "\n";
        echo self::color("TEST RESULTS SUMMARY", "1") . "\n";
        echo str_repeat("=", 40) . "\n";
        echo "Passed: " . self::color(self::$passed, "32") . "\n";
        echo "Failed: " . (self::$failed > 0 ? self::color(self::$failed, "31") : self::$failed) . "\n";
        
        if (self::$failed > 0) {
            echo "\n" . self::color("Failures details:", "31;1") . "\n";
            foreach (self::$failures as $index => $failure) {
                echo ($index + 1) . ") " . ($failure['suite'] ? "[{$failure['suite']}] " : "") . $failure['test'] . "\n";
                echo "   " . self::color($failure['message'], "33") . "\n";
                echo "   in {$failure['file']} on line {$failure['line']}\n\n";
            }
            exit(1);
        } else {
            echo "\n" . self::color("All tests passed successfully!", "32;1") . "\n\n";
            exit(0);
        }
    }
}
