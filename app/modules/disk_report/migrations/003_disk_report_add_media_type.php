<?php
// Adds media_type column and moves volumetype data to new column

use munkireport\lib\Schema;

class Migration_disk_report_add_media_type extends \Model
{
    /**
     * Migrate up
     *
     * Migrates this table to version 3
     *
     **/
    public function up()
    {
        Schema::table('diskreport', function ($table)
        {
            $table->string('media_type');
            $table->index('media_type');
        });
        
        // Populate new column
        $sql = "UPDATE diskreport 
                SET media_type = volumeType, volumeType = '-' 
                WHERE volumeType IN ('hdd', 'ssd', 'fusion', 'raid')";
        $this->exec($sql);

    }// End function up()

    /**
     * Migrate down
     *
     * Migrates this table to the previous version
     *
     **/
    public function down()
    {
        throw new Exception("Can't migrate back to version 2", 1);
        
    }
}
