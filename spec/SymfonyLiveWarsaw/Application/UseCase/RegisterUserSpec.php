<?php

declare(strict_types=1);

namespace spec\SymfonyLiveWarsaw\Application\UseCase;

use SymfonyLiveWarsaw\Application\UseCase\RegisterUser;
use SymfonyLiveWarsaw\Domain\Email;
use SymfonyLiveWarsaw\Domain\Users;
use SymfonyLiveWarsaw\Domain\User;
use SymfonyLiveWarsaw\Application\UseCase\RegisterUser\UserFactory;
use SymfonyLiveWarsaw\Application\Exception\UserAlreadyExists;
use PhpSpec\ObjectBehavior;

/**
 * @mixin RegisterUser
 */
class RegisterUserSpec extends ObjectBehavior
{
    function let(Users $users, UserFactory $userFactory)
    {
        $this->beConstructedWith($users, $userFactory);
    }

    function it_creates_user_base_on_given_data_and_store_in_persistence_layer(
        Users $users,
        UserFactory $userFactory,
        User $user
    ) {
        $users->has(Email::fromString('leszek.prabucki@gmail.com'))->willReturn(false);
        $users->add($user)->shouldBeCalled();
        $command = new RegisterUser\Command(
            'a35c7f52-fdf3-40ed-a69e-2c7f17d174e9',
            'leszek.prabucki@gmail.com',
            '$argon2id$v=19$m=1024,t=2,p=2$WXl6Wk5zWWpPY3RvWFloMA$emM94iLGzIMjqDC/uk6UFlRIhXQQ72t1f67L+LZEVQA'
        );
        $command = $command->withFullName('Leszek', 'Prabucki');

        $userFactory->create($command)->willReturn($user);

        $this->handle($command);
    }

    function it_cannot_register_user_with_same_email(Users $users)
    {
        $command = new RegisterUser\Command(
            'a35c7f52-fdf3-40ed-a69e-2c7f17d174e9',
            'leszek.prabucki@gmail.com',
            '$argon2id$v=19$m=1024,t=2,p=2$WXl6Wk5zWWpPY3RvWFloMA$emM94iLGzIMjqDC/uk6UFlRIhXQQ72t1f67L+LZEVQA'
        );

        $users->has(Email::fromString('leszek.prabucki@gmail.com'))->willReturn(true);

        $this->shouldThrow(UserAlreadyExists::class)->duringHandle($command);
    }
}
