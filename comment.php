<?php

/**
*Small cross section of a Nerd Nook comment
*This comment can be considered a small example of what services Nerd Nook store when comments are posted. This can easily
*be extended to emulate more features of Nerd Nook
*
*@author Chelsea David <cryan17@cnm.edu
*@version 1.0
**/

class comment {
	/*
	*id or this comment; this is the primary key
	*@var Uuid $comment
	*/
	private $commentId;
	/*
	 * id of the event the comment will be posted to; this is a foreign key
	 * @var Uuid $commentProfileId
	 *
	 */
	private $commentEventId;
	/*
	 * id of the profile that posted the comment
	 * @var Uuid $commentProfileId;
	 */
	private $commentProfileId;
	/*
	 * actual textual content of this comment
	 * @var string $commentContent
	 */
	private $commentContent;
	/*
	 * date and time this question was sent, in a PHP DateTime object
	 * @var \DateTime $commentDateTime
	 */
	private $commentDateTime;

	/*
	 * constructor for this comment
	 *
	 * @param Uuid $newCommentId
	 * @param Uuid $newCommentEventId
	 * @param Uuid $newCommentProfileId
	 * @param string $newCommentContent
	 * @param DateTime $newCommentDateTime
	 * @throws InvalidArgumentException
	 * @throws RangeException
	 * @throws Exception
	 * @throwsTypeError
	 */

	public function __construct(string $newCommentId, string $newCommentEventId, string $newCommentProfileId, string $newCommentContent, string $newCommentDateTime) {
		try{
			$this->setCommentId($newCommentId);
			$this->setCommentEventId($newCommentEventId);
			$this->setCommentProfileId($newCommentProfileId);
			$this->setCommentContent($newCommentContent);
			$this->setCommentDateTime($newCommentDateTime);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/*
	 * accessor method for commentId
	 *
	 * @return Uuid value of commentId
	 *
	 */
	public function getCommentId() : Uuid {
		return($this->commentId);
	}

	/*
	 * mutator method for commentId
	 *
	 * @param Uuid/string $newCommentId new value of commentId
	 * @throws \RangeException if $newCommentId is n
	 * @throws \TypeError if $newCommentId is not a uuid
	 */

	public function setCommentId($newCommentId) : void {
		try {
			$uuid = self :: validateUuid($newCommentId);
		}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentId = $uuid;
	}

	/*
	 * accessor method for commentEventId
	 *
		@return Uuid value of the commentEventId
	 *
	 */
	public function getCommentEventId() : Uuid {
		return($this->commentEventId);
		}

	/*
	 * mutator method for commentEventId
	 *
	 * @param string | Uuid $newCommentEventId new value of commentEventId
	 * @throws \InvalidArgumentException if $newCommentEventId is not a string or insecure
	 * @throws \TypeError if $newCommentEventId is not a Uuid
	 */

	public function setCommentEventId($newCommentEventId) : void {
		try {
			$uuid = self::ValidateUuid($newCommentEventId);
		} catch(\InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentEventId = $uuid;
	}

	/*
	 * accessor for commentProfileId
	 *
	 * @return Uuid value of the commentProfileId
	 */
	public function getCommentProfileId() : Uuid {
		return($this->commentProfileId);
	}

	/*
	 * mutator method for commentProfileId
	 *
	 * @param string | UUid $newCommentProfileId new value of commentProfileId
	 * @throws \InvalidArgumentException if $newCommentProfileId is not a string or insecure
	 * @throws \TypeError if $newCommentProfileId is not a Uuid
	 */

	public function setCommentProfileId($newCommentProfileId) : void {
		try {
			$uuid = self ::ValidateUuid($newCommentProfileId);
		}catch(\InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentProfileId = $uuid;
	}

	/*
	 * accessor for commentContent
	 *
	 * @return string value of the commentContent
	 */

	public function getCommentContent() : string {
		return($this->commentContent);
	}

	/*
	 * mutator method for commentContent
	 *
	 * @param string $newCommentConent new value of commentContent
	 * @throws \InvalidArgumentException if $newCommentContent is not a string or insecure
	 * @throws \RangeException if $newCommentContent is > 500 characters
	 * @throws \TypeError is $newCommentContent is not a string
	 */

	public function setCommentContent(string $newCommentContent) : void {
		$newCommentContent = trim($newCommentContent);
		$newCommentContent = filter_var($newCommentContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCommentContent) === true) {
			throw(new\InvalidArgumentException("Comment is empty or insecure"));
		}
		if(strlen($newCommentContent) > 500) {
			throw(new \RangeException("Comment must not exceed 500 characters"));
		}
		$this->commentContent = $newCommentContent;
	}

	/*
	 * accessor for commentDateTime
	 *
	 * @return \DateTime value of questionDateTime
	 */

	public function getCommentDateTime(): DateTime {
		return $this->commentDateTime;
	}
}