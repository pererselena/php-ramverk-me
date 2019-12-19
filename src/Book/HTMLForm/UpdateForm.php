<?php

namespace Anax\Book\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Book\Book;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $book = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $book->id,
                ],

                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $book->title,
                ],

                "author" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $book->author,
                ],

                "pages" => [
                    "type" => "number",
                    "validation" => ["not_empty"],
                    "value" => $book->pages,
                ],

                "published" => [
                    "type"        => "date",
                    "value" => $book->published,
                ],

                "image" => [
                    "type"        => "url",
                    "value" => $book->image,
                ],

                "category" => [
                    "type"        => "select-multiple",
                    "label"       => "Select one or more category:",
                    "size"        => 6,
                    "options"     => [
                        "art" => "art & photographi",
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
                    "checked"   => [$book->category],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     * @return Book
     */
    public function getItemDetails($id) : object
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $book->find("id", $id);
        return $book;
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
        $book->find("id", $this->form->value("id"));
        $book->title = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->pages = $this->form->value("pages");
        $book->published = $this->form->value("published");
        $book->image = $this->form->value("image");
        $book->category = implode(", ", $this->form->value("category"));
        $book->save();
        return true;
    }



    // /**
    //  * Callback what to do if the form was successfully submitted, this
    //  * happen when the submit callback method returns true. This method
    //  * can/should be implemented by the subclass for a different behaviour.
    //  */
    // public function callbackSuccess()
    // {
    //     $this->di->get("response")->redirect("book")->send();
    //     //$this->di->get("response")->redirect("book/update/{$book->id}");
    // }



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
