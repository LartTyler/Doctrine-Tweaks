<?php
	namespace Gravitas\Common\Doctrine\ORM\Query\AST\Functions;

	use Doctrine\ORM\Query\AST\Functions\FunctionNode;
	use Doctrine\ORM\Query\Lexer;
	use Doctrine\ORM\Query\Parser;
	use Doctrine\ORM\Query\SqlWalker;

	class TimestampDiffFunction extends FunctionNode {
		private $unit;
		private $interval;
		private $expr;

		public function getSql(SqlWalker $walker) {
			return sprintf('TIMESTAMPDIFF(%s, %s, %s)', strtoupper($this->unit), $this->start->dispatch($walker), $this->end->dispatch($walker));
		}

		public function parse(Parser $parser) {
			$parser->match(Lexer::T_IDENTIFIER);
			$parser->match(Lexer::T_OPEN_PARENTHESIS);
			$parser->match(Lexer::T_IDENTIFIER);

			$lexer = $parser->getLexer();
			$this->unit = $lexer->token['value'];

			$parser->match(Lexer::T_COMMA);

			$this->start = $parser->ArithmeticPrimary();

			$parser->match(Lexer::T_COMMA);

			$this->end = $parser->ArithmeticPrimary();

			$parser->match(Lexer::T_CLOSE_PARENTHESIS);
		}
	}
?>