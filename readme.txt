KEY POINTS

1. Application contains component folder, main logic placed here.

2. Application contains controller folder and vies. It's a very simplified part of mvc app without models.

3. Application works with session storage, but can be easily extended with any another data provider.
Dependency inversion was realized.

4. Bee entities can be observers and subjects, with two way definition. It allows us to manage the game behaviour
through a config file. For example in future we can subscribe different observers for different events, not only
when QueenBee becomeDead.

5. Game logic manager is the State.php class. It allows to get, set, change, and init game state for different steps of
game.

6. Tests placed in folder Tests.

7. phpunit install though composer, and runs from folder /vendor/bin like :

phpunit --bootstrap ../autoload.php ../../Tests

To install phpunit enter the BeeGame folder and run `composer install` command.

8. Application works with this url http://localhost/beegame/index.php

