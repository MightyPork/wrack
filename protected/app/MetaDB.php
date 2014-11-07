<?php namespace MightyPork\Wrack;

/**
 * Provides utils for database
 */
class MetaDB
{
	private static $pdo;

	/** Prepared article to get article by canonical name */
	private static $sArtByCanon;


	private static function _init()
	{
		if(self::$pdo != null) return;

		self::$pdo = new \PDO("sqlite:".APP_DIR."/db/meta.sqlite3");
		self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		self::$sArtByCanon = self::$pdo->prepare('SELECT * FROM articles WHERE canonical = :c LIMIT 1');
	}


	/** Record a "unique" article visit */
	public static function recordHit(Article $article)
	{
		self::_init();

		for($i=0; $i<2; $i++) {

			self::$sArtByCanon->execute([':c' => $article->canonical]);

			$rows = self::$sArtByCanon->fetchAll();

			if(!$rows) {
				self::createArticleRecord($article);
				continue;
			}

			break;
		}

		if(!$rows) throw new Exception('Could not create article record in metadata database.');

		$a = (object)$rows[0];

		$prep = self::$pdo->prepare('UPDATE articles SET hits = :hits, path = :path WHERE id = :id');

		$prep->execute([
			':id'    => $a->id,
			':hits'  => $a->hits + 1, // add new hit
			':path'  => $article->path // update to cutrrent path
		]);
	}


	/** Create a record for article */
	public static function createArticleRecord(Article $article)
	{
		$prep = self::$pdo->prepare('INSERT INTO articles (canonical, path) VALUES (:cn, :path)');
		$prep->execute([
			':cn'   => $article->canonical,
			':path' => $article->path
		]);
	}

}
