<?php

namespace Anax\Book\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Book\Book;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "require" => true,
                ],
                        
                "author" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "require" => true,
                ],

                "pages" => [
                    "type" => "number",
                    "validation" => ["not_empty"],
                    "require" => true,
                ],

                "published" => [
                    "type"        => "date",
                    "require" => true,
                ],

                "image" => [
                    "type"        => "url",
                ],

                "category" => [
                    "type"        => "select-multiple",
                    "label"       => "Select one or more category:",
                    "size"        => 6,
                    "options"     => [
                        "art & photographi" => "art",
                        "biography" => "biography",
                        "children"  => "children",
                        "craft & hobbies"   => "hobbies",
                        "crime" => "crime",
                        "thriller" => "thriller",
                        "fiction" => "fiction",
                        "food" => "food",
                        "anime" => "anime",
                        "history" => "history",
                        "drama" => "drama",
                        "poetry" => "poetry",
                        "fantasy" => "fantasy",
                        "horror" => "horror",
                        "science" => "science",
                        "health" => "health",
                        "humour" => "humour",
                        "computing" => "computing",
                        "education" => "education",
                    ],
                    "require" => true,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $book->title  = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->pages = $this->form->value("pages");
        $book->published = $this->form->value("published");
        $book->image = $this->form->value("image");
        $book->category = implode(", ", $this->form->value("category"));
        $book->save();

        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("book")->send();
    }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
