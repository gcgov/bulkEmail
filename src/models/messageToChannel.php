<?php
namespace gcgov\framework\services\bulkEmail\models;


class messageToChannel {

	public ?template $template = template::countyTemplate2023;

	public ?string $sendingDepartmentId = null;

	public string $channelId = '';

	public string $subject = '';

	public string $message = '';

	/**  @var string[] $cc */
	public array $cc  = [];

	/**  @var string[] $bcc */
	public array $bcc = [];

	public int $priority = 1000; //lower is higher priority

	public string $reference = '';


}
