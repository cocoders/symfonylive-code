<?php

declare(strict_types=1);

namespace spec\SymfonyLiveWarsaw\Application\UseCase;

use SymfonyLiveWarsaw\Application\UseCase\RegisterUser;
use SymfonyLiveWarsaw\Domain\Users;
use SymfonyLiveWarsaw\Domain\User;
use SymfonyLiveWarsaw\Application\UseCase\RegisterUser\UserFactory;
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
        $command = new RegisterUser\Command(
            'a35c7f52-fdf3-40ed-a69e-2c7f17d174e9',
            'leszek.prabucki@gmail.com',
            '$argon2id$v=19$m=1024,t=2,p=2$WXl6Wk5zWWpPY3RvWFloMA$emM94iLGzIMjqDC/uk6UFlRIhXQQ72t1f67L+LZEVQA'
        );
        $command = $command->withFullName('Leszek', 'Prabucki');

        $userFactory->create($command)->willReturn($user);

        $this->handle($command);

        $users->add($user)->shouldHaveBeenCalled();
    }
}
