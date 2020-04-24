<div class="sidebar">

    <div class="logo text-center">
        <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" class="court" style="width: 55px;">
    </div>

    <?php
        $sm     = '';
        
        foreach($modules as $key => $module){
            if(!is_array($module['link'])){
                $link     = 'class="link" u="'.$module['link'].'"';
            }else{
                $link = '#';
                $sm .= '<div class="subMenu" id="m_'.$key.'">';
                $sm .= "<div><strong class='subMenu-title'>".$module['props']->title."</strong> <i class='material-icons closeSM'>close</i></div>";
                foreach($module['link'] as $k => $val){
                    $sm .= "<div class='link' u='$val->link'> $val->title </div>";
                }
                $sm .= "</div>";
            }
?>
        <div class="item text-center" sid="m_<?php echo $key; ?>">
            <a <?php echo $link; ?>>
                <i class="material-icons"><?php echo $module['props']->icon; ?></i><br>
                <span><?php echo $module['props']->title; ?></span>
            </a>
        </div>
<?php
            
        }
    ?>
</div>

<?php echo $sm; ?>