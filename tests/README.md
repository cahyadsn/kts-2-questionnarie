# KTS-II Questionnaire Native PHP Unit Testing

This directory contains the unit tests and the custom, zero-dependency testing harness designed specifically for the KTS-II Questionnaire project.

## Overview

Since this project runs on pure native PHP without standard dependency managers like Composer, the test suite leverages a lightweight, custom test runner implemented in native PHP. This keeps the codebase highly portable, fast, and dependency-free.

## Directory Structure

* **`TestRunner.php`**: The custom testing framework. It handles organizing suites, executing tests, catching assertions/exceptions, colorizing console output, and generating failure reports.
* **`KtsTest.php`**: The unit test suite verifying environment configuration parsing and Keirsey Temperament Sorter scoring logic.
* **`README.md`**: This documentation file.

## Run Tests

Run the test suite using the root entry point:

```bash
php run_tests.php
```

Or run the test suite file directly:

```bash
php tests/KtsTest.php
```

## Writing Tests

You can define new test suites and test cases using the `TestRunner` class.

### 1. Create a Suite

A suite groups related tests together:

```php
TestRunner::runSuite('My Feature Suite', function() {
    // Tests go here...
});
```

### 2. Add Test Cases

Define individual test cases inside the suite:

```php
TestRunner::test('Verifies specific behavior', function() {
    $result = my_function_to_test();
    TestRunner::assertEquals('expected_value', $result, 'Optional failure message');
});
```

### 3. Available Assertions

The following assertion methods are available in `TestRunner`:

* **`TestRunner::assertEquals($expected, $actual, $message = '')`**: Asserts that two values are strictly equal (`===`).
* **`TestRunner::assertTrue($condition, $message = '')`**: Asserts that a condition is strictly `true`.
* **`TestRunner::assertFalse($condition, $message = '')`**: Asserts that a condition is strictly `false`.
* **`TestRunner::assertArrayHasKey($key, $array, $message = '')`**: Asserts that an array has the specified key.
