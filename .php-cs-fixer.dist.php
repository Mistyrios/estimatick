<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@Symfony' => true, // Règles Symfony de base
    '@PSR12' => true,   // Ajoute toutes les règles PSR-12
    'types_spaces' => [
        'space' => 'single', // Correspond à ce que PHPCBF veut
    ],

    // Personnalisations supplémentaires
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => ['=>' => null]
    ],
    'blank_line_before_statement' => [
        'statements' => ['return']
    ],
    'cast_spaces' => true,
    'class_attributes_separation' => [
        'elements' => [
            'method' => 'one',
            'trait_import' => 'none'
        ]
    ],
    'concat_space' => [
        'spacing' => 'one'
    ],
    'fully_qualified_strict_types' => true,
    'increment_style' => ['style' => 'post'],
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra',
            'throw',
            'use'
        ]
    ],
    'no_blank_lines_after_phpdoc' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_mixed_echo_print' => [
        'use' => 'echo'
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line'
    ],
    'no_short_bool_cast' => true,
    'no_spaces_around_offset' => true,
    'no_unneeded_control_parentheses' => true,
    'no_unreachable_default_argument_value' => true,
    'no_useless_return' => true,
    'no_whitespace_before_comma_in_array' => true,
    'normalize_index_brace' => true,
    'not_operator_with_successor_space' => false,
    'object_operator_without_whitespace' => true,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'phpdoc_indent' => true,
    'general_phpdoc_tag_rename' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_tag_type' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'psr_autoloading' => true,
    'self_accessor' => true,
    'short_scalar_cast' => true,
    'simplified_null_return' => false,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'ternary_operator_spaces' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    'no_unused_imports' => true,
];

$finder = (new Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setRules($rules)
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
