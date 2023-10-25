<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Database\Database;

/**
 * class Repository.
 *
 * @author jonas-elias
 */
class Repository
{
    /**
     * @var Database
     */
    protected Database $database;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        $this->database = $this->container::get('ExpertFramework\Database\Database');
    }

    /**
     * Method to begin PDO transaction.
     *
     * @return void
     */
    public function begin(): void
    {
        $this->database::begin();
    }

    /**
     * Method to commit transaction.
     *
     * @return void
     */
    public function commit(): void
    {
        $this->database::commit();
    }

    /**
     * Method to rollback transaction.
     *
     * @return void
     */
    public function rollback(): void
    {
        $this->database::rollback();
    }
}
