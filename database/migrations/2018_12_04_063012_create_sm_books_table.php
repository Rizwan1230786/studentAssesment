<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmBook;
class CreateSmBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_category_id')->nullable()->unsigned();
            $table->string('book_title',100)->nullable();
            $table->string('book_number',100)->nullable();
            $table->string('isbn_no',100)->nullable();
            $table->string('publisher_name',100)->nullable();
            $table->string('author_name',100)->nullable();
            $table->string('subject',100)->nullable();
            $table->string('rack_number',50)->nullable();
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('book_price')->nullable();
           
            $table->date('post_date')->nullable();
            $table->string('details',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        $books = [
                'Algorithms & Data Structures',
                'Cellular Automata',
                'Cloud Computing',
                'Competitive Programming',
                'Compiler Design',
                'Database',
                'Datamining',
                'Information Retrieval',
                'Licensing',
                'Machine Learning',
                'Mathematics',
                'Misc',
                'MOOC',
                'Networking',
                'Open Source Ecosystem',
                'Operating Systems',
                'Parallel Programming',
                'Partial Evaluation',
                'Professional Development',
                'Programming Paradigms',
                'Regular Expressions',
                'Reverse Engineering',
                'Security',
                'Software Architecture',
                'Standards',
                'Theoretical Computer Science',
                'Web Performance'
            ];
            $i=1;
            foreach ($books as $book) { 
            $store = new SmBook();
            $store->book_category_id = $i;
            $store->book_title = $book;
            $store->book_number = 'B-'.$i;
            $store->isbn_no = 'ISBN-0'.$i;
            $store->publisher_name = 'Spondon';
            $store->author_name = 'Author Spondon';
            $store->subject = 1+ $i%5;
            $store->rack_number = $i;
            $store->quantity =100+ $i;
            $store->book_price =300+ 20* $i; 
            $store->save();
            $i++;
        }
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_books');
    }
}
