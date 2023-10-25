<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository;

use ExpertFramework\Container\Container;
use ExpertFramework\Database\Database;

/**
 * class Repository
 *
 * @package Jonaselias\ExpertFramework\Repository
 * @author jonas-elias
 */
class Repository
{
    /**
     * @var Database $database
     */
    protected Database $database;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->database = Container::get('ExpertFramework\Database\Database');
    }

    /**
     * Method to begin PDO transaction
     *
     * @return void
     */
    public function begin(): void
    {
        $this->database::begin();
    }

    /**
     * Method to commit transaction
     *
     * @return void
     */
    public function commit(): void
    {
        $this->database::commit();
    }

    /**
     * Method to rollback transaction
     *
     * @return void
     */
    public function rollback(): void
    {
        $this->database::rollback();
    }
}
