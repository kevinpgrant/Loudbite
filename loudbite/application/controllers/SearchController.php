<?php
/**
 * Search Controller
 *
 */
class SearchController extends Zend_Controller_Action
{

    /**
     * Create Index.
     *
     */
    public function createIndexAction(){

       try{

          //Create an index.
          $Index = Zend_Search_Lucene::create('../application/searchindex');

          //Create a Document
          $Artist1 = new Zend_Search_Lucene_Document();
          $Artist2 = new Zend_Search_Lucene_Document();
          $Artist3 = new Zend_Search_Lucene_Document();
          $Artist4 = new Zend_Search_Lucene_Document();
          $Artist5 = new Zend_Search_Lucene_Document();

          //Add the artist data
          $Artist1->addField(Zend_Search_Lucene_Field::
                    Text('artist_name', 'Paul Oakenfold', 'utf-8'));
          $Artist1->addField(Zend_Search_Lucene_Field::
                    Keyword ('genre', 'electronic'));
          $Artist1->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('date_formed', '1990'));
          $Artist1->addField(Zend_Search_Lucene_Field::
                    Text('description', 'Paul Oakenfold description
                         will go here.'));
          $Artist1->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('artist_id', '1'));
          $Artist1->addField(Zend_Search_Lucene_Field::
                    UnStored('full_profile', "Paul Oakenfold's
                             Full Profile will go here."));

          $Artist2->addField(Zend_Search_Lucene_Field::
                    Text('artist_name', 'Christopher Lawrence', 'utf-8'));
          $Artist2->addField(Zend_Search_Lucene_Field::
                    Keyword ('genre', 'electronic'));
          $Artist2->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('date_formed', '1991'));
          $Artist2->addField(Zend_Search_Lucene_Field::
                    Text('description', 'Christopher Lawrence description
                         will go here.'));
          $Artist2->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('artist_id', '2'));
          $Artist2->addField(Zend_Search_Lucene_Field::
                    UnStored('full_profile', "Christopher Lawrence's
                             Full Profile will go here."));

          $Artist3->addField(Zend_Search_Lucene_Field::
                    Text('artist_name', 'Sting', 'utf-8'));
          $Artist3->addField(Zend_Search_Lucene_Field::
                    Keyword ('genre', 'rock'));
          $Artist3->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('date_formed', '1982'));
          $Artist3->addField(Zend_Search_Lucene_Field::
                    Text('description', 'Sting description
                         will go here.'));
          $Artist3->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('artist_id', '3'));
          $Artist3->addField(Zend_Search_Lucene_Field::
                    UnStored('full_profile', "Sting's Full Profile
                             will go here."));

          $Artist4->addField(Zend_Search_Lucene_Field::
                    Text('artist_name', 'Elton John', 'utf-8'));
          $Artist4->addField(Zend_Search_Lucene_Field::
                    Keyword ('genre', 'rock'));
          $Artist4->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('date_formed', '1970'));
          $Artist4->addField(Zend_Search_Lucene_Field::
                    Text('description', 'Elton John description
                         will go here.'));
          $Artist4->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('artist_id', '4'));
          $Artist4->addField(Zend_Search_Lucene_Field::
                    UnStored('full_profile', "Elton John's Full Profile
                             will go here."));

          $Artist5->addField(Zend_Search_Lucene_Field::
                    Text('artist_name', 'Black Star', 'utf-8'));
          $Artist5->addField(Zend_Search_Lucene_Field::
                    Keyword ('genre', 'hip hop'));
          $Artist5->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('date_formed', '1999'));
          $Artist5->addField(Zend_Search_Lucene_Field::
                    Text('description', 'Black Star description
                         will go here.'));
          $Artist5->addField(Zend_Search_Lucene_Field::
                    UnIndexed ('artist_id', '3'));
          $Artist5->addField(Zend_Search_Lucene_Field::
                    UnStored('full_profile', "Black Star's Full Profile
                             will go here."));

    /*
    Field Type: UnStored
    The UnStored field type indexes and tokenizes the data, but does not store the content as the Text and
    Keyword field types do. The UnStored field type keeps the data in memory. The user can search for
    content in these fields, but the data has to be retrieved from other sources (such as a database or a file)
    to display to the user.
    Listing 8-9 demonstrates an example implementation of this field type by creating two
    additional fields for each document. The first field, full_profile, contains a very long description of the
    artist; the second field, artist_id, contains the unique ID given to the artist within a database table.
    The user can search within the UnStored field; if there are any matching documents, use the
    artist_id field to fetch the specific row in a database table.

    Tip - If you've been following along and building the LoudBite application, these fields do not appear in the
    database tables; they are used here only as an example.
    */


          //Add the documents to the Index
          $Index->addDocument($Artist1);
          $Index->addDocument($Artist2);
          $Index->addDocument($Artist3);
          $Index->addDocument($Artist4);
          $Index->addDocument($Artist5);

          echo 'Index created<br/>';
          echo 'Total Documents: '.$Index->maxDoc();

       }catch(Zend_Search_Exception $e){

          echo $e->getMessage();

       }

       //Suppress the view.
       $this->_helper->viewRenderer->setNoRender();

    }


    /**
     * Delete the Documents
     *
     */
    public function deleteDocumentAction()
    {
        try
        {

            //Open the index for reading.
            $Index = Zend_Search_Lucene::open('../application/searchindex');

            //Create the term to delete the documents.
            $hits = $Index->find('genre:electronic');

            foreach($hits as $hit)
            {
                $Index->delete($hit->id);
            }

            $Index->commit();
        }
        catch(Zend_Search_Exception $e)
        {
            echo $e->getMessage();

        }
        echo 'Deletion completed<br/>';
        echo 'Total documents: '.$Index->numDocs();

        //Suppress the view
        $this->_helper->viewRenderer->setNoRender();
    }


    /**
      * ParseHtml Action
      *
      */
    public function parsehtmlAction(){

       try{

          //Open the Index for updating.
          $Index = Zend_Search_Lucene::open('../application/searchindex');

          //Set Path to the HTML to parse.
          $htmlDocPath = '/var/www/loudbite/public/Listing_8_11.html'; // '<PATH TO YOUR FILE>';

          //Check if the file is present
          if(!file_exists($htmlDocPath)){
             throw new Exception("Could not find file $htmlDocPath.");
          }

          //Parse the the HTML file.
          $htmlDoc = Zend_Search_Lucene_Document_Html:: loadHTMLFile ($htmlDocPath);

          //Example of getters and property calls.
          $links             = $htmlDoc->getLinks();
          $headerLinks = $htmlDoc->getHeaderLinks ();
          $title               = $htmlDoc->title;
          $body             = $htmlDoc->body;

          //Add the content to the Index.
          $Index->addDocument($htmlDoc);

          echo 'Successfully parsed HTML file.<br/>';
          echo 'Total Documents:'. $Index->numDocs().'<br/><br/>';

          //Validate parsed links within document
          echo "Links Parsed<br/>";
          foreach($links as $link){

             echo "$link <br/>";

          }

       }catch(Zend_Search_Exception $e){

          echo $e->getMessage();

       }

       //Suppress the view
       $this->_helper->viewRenderer->setNoRender();
    }



    /**
     * Parse Word 2007 File.
     *
     */
    public function parseworddocAction(){

       try{

          //Open the index.
          $Index = Zend_Search_Lucene:: open("../application/searchindex");

          //Initialize Word Document Path

          // https://secure.convert-doc.com/converters/doc-to-docx.html =)
          $wordDocPath = '/var/www/loudbite/public/converted.docx'; //'<PATH TO YOUR Word FILE>';

          //Load and parse the Word Doc.
          $wordDoc = Zend_Search_Lucene_Document_Docx::
                     loadDocxFile($wordDocPath, true);

          //Example of getters.
          $title              = $wordDoc->title;
          //$createdDate = $wordDoc->created;
          $body            = $wordDoc->body;

          //Add the Document into the index
          $Index->addDocument($wordDoc);

          echo 'Successfully parsed Word file.<br/>';
          echo 'Total Documents: '.$Index->numDocs().'<br/>';

          //Display Word document information
        echo "Title of Word document: $title <br/>";
        echo "Created Date of Document: $createdDate";

       }catch(Zend_Search_Lucene_Exception $e){

          echo $e->getMessage();

       }

       //Suppress the view
       $this->_helper->viewRenderer->setNoRender();

    }


    /**
     * Result.  Fetch the result and display to the user.
     *
     */
    public function resultAction_Listing_8_13(){


       //Open the index to search in.
       $Index = Zend_Search_Lucene:: open('../application/searchindex');

       //Set the properties for the Index.
       $Index->setDefaultSearchField('artist_name');

       //Construct Query
       $query = 'paul*';
       //Search.
       $hits = $Index->find($query);

       //Set the view variables
       $this->view->hits = $hits;
    }


    /**
     * Result.  Fetch the result and display to the user.
     *
     */
    public function resultAction_Listing_8_15(){

       //Open the index to search in.
       $Index = Zend_Search_Lucene:: open('../application/searchindex');

       //Set the properties for the Index.
       $Index->setDefaultSearchField('artist_name');
       $Index->setResultSetLimit(1);

       //Construct Query
       $query = 'genre:rock';

       //Search.
       $hits = $Index->find($query);

       //Set the view variables
       $this->view->hits = $hits;

    }

    /**
     * Result.  Fetch the result and display to the user.
     *
     */
    // public function resultAction_Listing_8_16(){
    public function resultAction()
    {
        //Open the index to search in.
        $Index = new Zend_Search_Lucene('../application/searchindex');

        //Set the properties for the Index.
        $Index->setDefaultSearchField('artist_name');
        $Index->setResultSetLimit(3);

        //Construct Query
        $query = 'genre:rock';

        //Search.
        $hits = $Index->find($query, 'artist_name', SORT_STRING, SORT_ASC);

        //Set the view variables
        $this->view->hits = $hits;
    }
}
