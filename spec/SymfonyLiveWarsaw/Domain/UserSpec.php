<?php

declare(strict_types=1);

namespace spec\SymfonyLiveWarsaw\Domain;

use SymfonyLiveWarsaw\Domain\User;
use SymfonyLiveWarsaw\Domain\Email;
use SymfonyLiveWarsaw\Domain\User\PasswordHash;
use SymfonyLiveWarsaw\Domain\User\Fullname;
use PhpSpec\ObjectBehavior;

/**
 * @mixin User
 */
class UserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            User\Id::fromString('35f15ad1-b764-4f22-a655-e2ef3873dfc3'),
            Email::fromString('leszek.prabucki@gmail.com'),
            PasswordHash::fromString('$argon2id$v=19$m=1024,t=2,p=2$WXl6Wk5zWWpPY3RvWFloMA$emM94iLGzIMjqDC/uk6UFlRIhXQQ72t1f67L+LZEVQA')
        );
    }

    function it_is_initialized_with_required_data_like_id_email_and_username()
    {
        $this->shouldBeAnInstanceOf(User::class);
    }

    function it_allows_to_get_email()
    {
        $this->email()->shouldBeLike(Email::fromString('leszek.prabucki@gmail.com'));
    }

    function it_allows_to_get_id()
    {
        $this->id()->shouldBeLike(User\Id::fromString('35f15ad1-b764-4f22-a655-e2ef3873dfc3'));
    }

    function it_to_set_full_name()
    {
        $this->fullname()->shouldBe(null);

        $this->changeFullname(Fullname::fromFirstAndLastName('Leszek', 'Prabucki'));
        $this->fullname()->shouldBeLike(Fullname::fromFirstAndLastName('Leszek', 'Prabucki'));
    }
}
