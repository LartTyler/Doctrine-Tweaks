<?php
	namespace DaybreakStudios\Doctrine\ORM\Query\AST\Functions;

	use Doctrine\ORM\Query\AST\Functions\FunctionNode;
	use Doctrine\ORM\Query\Lexer;
	use Doctrine\ORM\Query\Parser;
	use Doctrine\ORM\Query\SqlWalker;

	class IfFunction extends FunctionNode {
		private $args = array();

		public function getSql(SqlWalker $walker) {
			return sprintf('IF(%s, %s, %s)',
				$walker->walkConditionalExpression($this->args[0]),
				$walker->walkArithmeticPrimary($this->args[1]),
				$walker->walkArithmeticPrimary($this->args[2])
			);
		}

		public function parse(Parser $parser) {
			$parser->match(Lexer::T_IDENTIFIER);
			$parser->match(Lexer::T_OPEN_PARENTHESIS);

			$this->args[] = $parser->ConditionalExpression();

			for ($i = 0; $i < 2; $i++) {
				$parser->match(Lexer::T_COMMA);

				$this->args[] = $parser->ArithmeticExpression();
			}

			$parser->match(Lexer::T_CLOSE_PARENTHESIS);
		}
	}
?>