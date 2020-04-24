
    <div class="row m-1 item_manage">
        <div class="col-md-3 p-0 ">
            <div class="item_manage_tabs">
                <div class="strong p-3 title"><strong><?php echo $row['_title']; ?></strong></div>
                <div class="tab-item-f p-1"></div>
                <?php
                    $c = 0;
                    foreach($tabs as $tab){

                        $args   = $tab + $row;
                        $act    = $args['method'];

                        $active = $c++ ? '' : 'active';
                        echo '<div class="tab-item p-3 '.$active.'" act="'.$act.'" args="'.http_build_query($args).'">'.$tab['label'].'</div>';
                    }
                ?>
                <div class="tab-item-f p-3"></div>
            </div>
        </div>

        <div class="col-md-9 item_manage_content" id="item_content">
            tab content
        </div>
    </div>
