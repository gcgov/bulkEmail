<?php
namespace gcgov\framework\services\bulkEmail\models;

class messageToEmail {

	public ?template $template = template::countyTemplate2023;

	public ?string $sendingDepartmentId = null;

	public string $subject = '';

	public string $message = '';

	/**  @var string[] $to */
	public array $to  = [];

	/**  @var string[] $cc */
	public array $cc  = [];

	/**  @var string[] $bcc */
	public array $bcc = [];

	public int $priority = 1000; //lower is higher priority

	public string $reference = '';

}
