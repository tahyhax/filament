<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// Get modified files from Git
$modifiedFiles = [];
exec('git ls-files -m', $modifiedFiles);
exec('git ls-files --others --exclude-standard', $untrackedFiles);
$modifiedFiles = array_merge($modifiedFiles, $untrackedFiles);

// Filter PHP files only
$modifiedFiles = array_filter($modifiedFiles, function ($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'php';
});

$rules = [
    '@PSR12' => true,
    'strict_param' => true,
    'declare_strict_types' => true,
    
    // Array rules
    'array_syntax' => ['syntax' => 'short'],
    'array_indentation' => true,
    'array_push' => true,
    'trim_array_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'trailing_comma_in_multiline' => ['elements' => ['arrays']],
    
    // Import and namespace rules
    'no_unused_imports' => true,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'no_leading_import_slash' => true,
    'no_leading_namespace_whitespace' => true,
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,
    
    // Whitespace rules
    'no_whitespace_in_blank_line' => true,
    'blank_lines_before_namespace' => true,
    
    // PHPDoc rules
    'phpdoc_align' => ['align' => 'left'],
    'phpdoc_scalar' => true,
    'phpdoc_to_param_type' => true,
    'phpdoc_to_return_type' => true,
    'phpdoc_var_without_name' => true,
    'phpdoc_no_empty_return' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_trim' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_types_order' => [
        'null_adjustment' => 'always_last',
        'sort_algorithm' => 'none',
    ],
    'phpdoc_array_type' => true,
    
    // PHPUnit rules
    'php_unit_strict' => true,
    'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
    
    // Other rules
    'single_quote' => true,
    'no_superfluous_phpdoc_tags' => true,
    'no_blank_lines_after_phpdoc' => true,
    'return_type_declaration' => ['space_before' => 'none'],
    'single_blank_line_at_eof' => true,
    'single_line_comment_style' => ['comment_types' => ['hash']],
    'strict_comparison' => true,
    'types_spaces' => ['space' => 'none'],
    'void_return' => true,
    'fully_qualified_strict_types' => true,
    'global_namespace_import' => [
        'import_classes' => true,
        'import_constants' => true,
        'import_functions' => true,
    ],
    'phpdoc_order' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_types' => true,
];

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->exclude([
        'bootstrap/cache',
        'storage',
        'vendor',
    ]);

// If there are modified files, only check those
if (!empty($modifiedFiles)) {
    $finder->name(array_map(function ($file) {
        return basename($file);
    }, $modifiedFiles));
}

return (new Config())
    ->setRules($rules)
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(false); 