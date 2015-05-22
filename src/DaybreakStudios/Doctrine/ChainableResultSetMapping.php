<?php
	namespace DaybreakStudios\Doctrine;

	use Doctrine\ORM\Query\ResultSetMapping;

	class ChainableResultSetMapping extends ResultSetMapping
	{
		public function addEntityResult($class, $alias, $resultAlias = null)
		{
			parent::addEntityResult($class, $alias, $resultAlias);

			return $this;
		}

		public function addIndexBy($alias, $fieldName)
		{
			parent::addIndexBy($alias, $fieldName);

			return $this;
		}

		public function addFieldResult($alias, $columnName, $fieldName, $declaringClass = null)
		{
			parent::addFieldResult($alias, $columnName, $fieldName, $declaringClass);

			return $this;
		}

		public function addJoinedEntityResult($class, $alias, $parentAlias, $relation)
		{
			parent::addJoinedEntityResult($class, $alias, $parentAlias, $relation);

			return $this;
		}

		public function addScalarResult($columnName, $alias, $type = 'string')
		{
			parent::addScalarResult($columnName, $alias, $type);

			return $this;
		}

		public function addMetaResult($alias, $columnName, $fieldName, $isIdentifierColumn = false, $type = null)
		{
			parent::addMetaResult($alias, $columnName, $fieldName, $isIdentifierColumn, $type);

			return $this;
		}
	}
?>