<?php
namespace Task\Model;

class Entities
{
	public static function fix($path)
	{
		foreach (glob($path . '/*.php') as $filename) {
			$basename = basename($filename);
			echo $basename . '...';
			if ($basename === 'MigrationVersion.php') {
				unlink($filename);
				echo ' [Removed]' . PHP_EOL;
			} else {
				$file = file_get_contents($filename);
				file_put_contents($filename, strtr($file, [
					'@ORM\Entity' => '@ORM\MappedSuperclass',
					'class ' => 'abstract class '
				]));
				echo ' [OK]' . PHP_EOL;
			}
		}
	}
}
