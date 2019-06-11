<?php

declare(strict_types=1);

namespace spec\SymfonyLiveWarsaw\Domain;

use SymfonyLiveWarsaw\Domain\Email;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Email
 */
class EmailSpec extends ObjectBehavior
{
    function it_do_not_initialize_with_value_which_is_not_in_html5_allowed_format()
    {
        $this->beConstructedThrough(
            'fromString',
            [
                'lesze@k'
            ]
        );

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    function it_is_initialized_for_valid_value()
    {
        $this->beConstructedThrough('fromString', ['contact@cocoders.com']);

        $this->toString()->shouldBe('contact@cocoders.com');
    }

    function it_normalize_given_value()
    {
        $this->beConstructedThrough('fromString', ['Contact@cocoders.com']);

        $this->toString()->shouldBe('contact@cocoders.com');
    }
}
