<?php

namespace spec\TableNode\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NestedTableNodeSpec extends ObjectBehavior
{
    function let()
    {
        $table = [
            5 => [
                'article.id',
                'article.author.date.id'
            ],
            6 => [
                1,
                12
            ],
            7 => [
                4,
                133
            ]
        ];

        $this->beConstructedWith($table);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TableNode\Extension\NestedTableNode');
    }

    function it_should_return_proper_multidimensional_array()
    {
        $expectedHash = [
            [
                'article' => [
                    'id' => 1,
                    'author' => [
                        'date' => [
                            'id' => 12
                        ]
                    ]
                ]
            ],
            [
                'article' => [
                    'id' => 4,
                    'author' => [
                        'date' => [
                            'id' => 133
                        ]
                    ]
                ]
            ]
        ];

        $this->getNestedHash()->shouldReturn($expectedHash);
    }
}
