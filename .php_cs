<?php

$header = <<<EOF
This file is part of the Meli library.

(c) Bruno Galeotti <bgaleotti@gmail.com>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

\Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

$finder = \Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__.'/src')
    ->notName('*Spec.php')
;

return \Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->fixers([
        'unalign_double_arrow',
        'unalign_equals',
        'header_comment',
        'ordered_use',
        'short_array_syntax',
        'strict',
        'strict_param',
        'phpdoc_order',
    ])
;
