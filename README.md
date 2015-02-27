# Doctrine Tweaks

A collection of files that modify or add to Doctrine's functionality.

This package is meant to be used in conjunction with Symfony. It has not been tested outside of the Symfony environment,
but **should** be usable anywhere.

# Usage: ChainableEntityManager

This package includes a file named `DaybreakStudios\Doctrine\ORM\ChainableEntityManager` that allows a few
common methods to be chained together. For example:

```
// $em = getOurEntityManager();

$em
	->persist($entity1)
	->persist($entity2)
	->flush();
```

Chainable methods are as follows: `persist`, `remove`, `detach`, `refresh`, and `flush`.
