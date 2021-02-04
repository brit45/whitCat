<?php

class Test_Migrate_123456789 extends Migrate {

    function up() {

        $t = new Blueprint;
        $t->id();
        $t->varchar('email',100);
        $t->text('comment');
        $t->date('created_at');
        $t->date('updated_at');
        

        $this->create('Test', $t);
    }
}