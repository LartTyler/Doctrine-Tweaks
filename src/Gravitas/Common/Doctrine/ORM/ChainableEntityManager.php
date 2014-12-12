<?php
	namespace Gravitas\Common\Doctrine\ORM;

	use \InvalidArgumentException;

	use Doctrine\Common\EventManager;
	use Doctrine\DBAL\Connection;
	use Doctrine\DBAL\DriverManager;
	use Doctrine\ORM\Configuration;
	use Doctrine\ORM\EntityManager;
	use Doctrine\ORM\ORMException;

	class ChainableEntityManager extends EntityManager {
		protected function __construct($conn, Configuration $config, EventManager $eventManager) {
			parent::__construct($conn, $config, $eventManager);
		}

		public function persist($entity) {
			parent::persist($entity);

			return $this;
		}

		public function remove($entity) {
			parent::remove($entity);

			return $this;
		}

		public function detach($entity) {
			parent::detach($entity);

			return $this;
		}

		public function refresh($entity) {
			parent::refresh($entity);

			return $this;
		}

		public function flush($entity = null) {
			parent::flush($entity);

			return $this;
		}

		public static function create($conn, Configuration $config, EventManager $eventManager = null) {
			if (!$config->getMetadataDriverImpl())
				throw ORMException::missingMappingDriverImpl();

			if (is_array($conn))
				$conn = DriverManager::getConnection($conn, $config, $eventManager ?: new EventManager());
			else if ($conn instanceof Connection) {
				if ($eventManager !== null && $conn->getEventManager() !== $eventManager)
					throw ORMException::mismatchedEventManager();
			} else
				throw new InvalidArgumentException('Invalid argument: ' . $conn);

			return new ChainableEntityManager($conn, $config, $conn->getEventManager());
		}
	}
?>