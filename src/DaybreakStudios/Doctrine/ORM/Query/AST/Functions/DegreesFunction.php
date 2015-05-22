<?php
	namespace DaybreakStudios\Doctrine\ORM\Query\AST\Functions;

	use Doctrine\ORM\Query\AST\Functions\FunctionNode;
	use Doctrine\ORM\Query\Lexer;
	use Doctrine\ORM\Query\Parser;
	use Doctrine\ORM\Query\SqlWalker;

	class DegreesFunction extends FunctionNode {
		private $arg;

		public function getSql(SqlWalker $walker) {
			return sprintf('DEGREES(%f)', $this->arg->dispatch($walker));
		}

		public function parse(Parser $parser) {
			$parser->match(Lexer::T_IDENTIFIER);
			$parser->match(Lexer::T_OPEN_PARENTHESIS);

			$this->arg = $parser->ArithmeticPrimary();

			$parser->match(Lexer::T_CLOSE_PARENTHESIS);
		}
	}
?>