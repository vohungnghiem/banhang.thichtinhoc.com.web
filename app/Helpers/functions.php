<?php
function date_img($date)
{
    return date('Y', strtotime($date)).'/'.date('m',strtotime($date));
}
function datevn($date)
{
    return date('d - m - Y',strtotime($date));
}
function datevnfull($date)
{
    return date('d',strtotime($date)). ' tháng '. date('m',strtotime($date)). ' năm ' .	date('Y',strtotime($date));
}
function baohanh($item) 
{
    $date1= date_create($item->date_import);
    $date2= date_create(date('d-m-Y'));
    $diff = date_diff($date1,$date2)->format("%y") * 12 + date_diff($date1,$date2)->format("%m");
    $bh = ($item->warranty - $diff < 0) ? 0 : $item->warranty - $diff;
    return '(BH: '. $bh .'th)';
}
function is_invalid($date)
{
    if ($date == '1970-01-01' || $date == null) {
        return 'is-invalid';
    }else{
        return '';
    }
}

function storage_link($thumb,$date) {
    return $thumb."/".date_img($date)."/";
}
function storage_link_show($thumb,$date) {
    return "storage/".$thumb."/".date_img($date)."/";
}
function error_img() {
    return 'onerror=this.onerror=null;this.src=`logo/none.png`';
}




// category dequy
function showCategories($categories, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent == $parent_id)
        {
            echo '<option value="'.$item->id.'">';
                echo $char . $item->name;
            echo '</option>';
            // unset($categories[$key]);
            showCategories($categories, $item->id, $char.'|---');
        }
    }
}

// category dequy
function showCategoriesSelected($categories, $parent_id = 0, $char = '---',$id)
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent == $parent_id)
        {
            if ($item->id == $id)
            {
                echo "<option value='$item->id' selected>";
                echo $char . $item->name;
                echo '</option>';
            }else{
                echo "<option value='$item->id'>";
                echo $char . $item->name;
                echo '</option>';
            }

            showCategoriesSelected($categories, $item->id, $char.'|---',$id);
        }
    }
}

// category dequy
function editCategoriesSelected($categories, $parent_id = 0, $char = '',$id)
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent == $parent_id)
        {
            if ($item->id == $id)
            {
                echo '<p class="current">'.$char . $item->name.'</p>';
            }else{
                echo '<p>'.$char . $item->name.'</p>';
            }

            editCategoriesSelected($categories, $item->id, $char.'<i class="fas fa-ellipsis-h"></i> &nbsp;',$id);
        }
    }
}
