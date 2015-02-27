<?php
	namespace DaybreakStudios\Doctrine\ORM\Query\AST\Functions;

	use Doctrine\ORM\Query\AST\Functions\FunctionNode;
	use Doctrine\ORM\Query\Lexer;
	use Doctrine\ORM\Query\Parser;
	use Doctrine\ORM\Query\SqlWalker;

	class TimestampSubFunction extends FunctionNode {
		private $unit;
		private $interval;
		private $expr;

		public function getSql(SqlWalker $walker) {
			return sprintf('TIMESTAMPADD(%s, -%d, %s)', strtoupper($this->unit), $this->interval->dispatch($walker), $this->expr->dispatch($walker));
		}

		public function parse(Parser $parser) {
			$parser->match(Lexer::T_IDENTIFIER);
			$parser->match(Lexer::T_OPEN_PARENTHESIS);
			$parser->match(Lexer::T_IDENTIFIER);

			$lexer = $parser->getLexer();
			$this->unit = $lexer->token['value'];

			$parser->match(Lexer::T_COMMA);

			$this->interval = $parser->ArithmeticPrimary();

			$parser->match(Lexer::T_COMMA);

			$this->expr = $parser->ArithmeticPrimary();

			$parser->match(Lexer::T_CLOSE_PARENTHESIS);
		}
	}
?>