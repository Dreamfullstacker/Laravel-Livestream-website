<?php

/**
 *
 * @param  Nav
 * @return mixed
 */
function nav($nav = null, $active = null, $count = null)
{
    $i = 0;
    foreach ($nav as $row) {
        if ($row['header']) {
            
            $html .= '<li class="nav-header hidden-folded ' . $row['class'] . '">
                              <span class="text-xs hidden-folded">' . $row['header'] . '</span>
                          </li>';
        } else {
            $html .= '<li class="' . $row['margin'];
            if ($active == $row['main']) {
                $html .= ' active';
            }
            $html .= '"';
            
            $html .= '>
                      <a href="';
            if (!$row['sub']) {
                $html .= APP . '/' . $row['url'];
            } else {
                $html .= 'javascript:;';
            }
            $html .= '">';
            
            if ($row['main']) {
                $html .= '<div class="nav-text-2x">';
                $html .= '<div class="nav-text">' . $row['name'] . '</div>';
                $html .= '<div class="nav-subtext">' . $count[$row['main']] . ' ' . $row['subtext'] . '</div>';
                $html .= '</div>';
            } else {
                $html .= '<span class="nav-text">' . $row['name'] . '</span>';
            }
            
            if ($row['sub']) {
                $html .= '<span class="nav-caret"></span>';
            }
            $html .= '</a>';
            if ($row['sub']) {
                $html .= '<ul class="nav-sub">';
                foreach ($row['sub'] as $SubCategory) {
                    $html .= '<li><a href=\'' . APP . '/' . $SubCategory['url'] . '\'><span class="nav-text">' . $SubCategory['name'] . '</span></a></li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        $i++;
    }
    return $html;
}

/**
 *
 * @param  Language
 * @return mixed
 */
function __($str) {
    global $Settings; 
    $language   = ACTIVE_LANG; 
    if(file_exists(PATH.'/locale/'.$language.'.php')) :
        include PATH.'/locale/'.$language.'.php';
    else:
        include PATH.'/locale/en.php';
    endif ; 
    
    if($Lang[$str]) :
        return $Lang[$str];
    else :
        return $str;
    endif ;
}
/**
 *
 * @param  Avatar
 * @return mixed
 */

function gravatar($Id = null, $Avatar = null, $Name = null, $Class = null, $Color = null)
{
    if ($Color) {
        $Color = 'background-color:' . $Color . ';color:#fff;';
    }
    if ($Avatar) {
        return '<div class="' . $Class . '" style="background-image:url(' . UPLOAD . '/user/' . $Avatar . ');' . $Color . '"></div>';
    } else {
        return '<div class="' . $Class . '" style="' . $Color . '">' . mb_strtoupper(mb_substr($Name, 0, 1, "UTF-8"), "UTF-8") . '</div>';
    }
}


/**
 *
 * @param  Dating
 * @return mixed
 */

function dating($str = null, $clocker = null, $format = null)
{
    $day = date('w', strtotime($str));
    $str = preg_split("/[-\\:\\/ ]/", $str);
    if ($format) {
        $day = $str[0];
        $month  = $str[1];
        $year = $str[2];
    } else {
        $day = $str[2];
        $month  = $str[1];
        $year = $str[0];
    }
    $hour     = $str[3];
    $minute   = $str[4];
    $second   = $str[5];
    $months = array(
        "01" => __('January'),
        "02" => __('February'),
        "03" => __('March'),
        "04" => __('April'),
        "05" => __('May'),
        "06" => __('June'),
        "07" => __('July'),
        "08" => __('August'),
        "09" => __('September'),
        "10" => __('October'),
        "11" => __('November'),
        "12" => __('December')
    );
    
    $days = array(
        '1' => __('Monday'),
        '2' => __('Tuesday'),
        '3' => __('Wednesday'),
        '4' => __('Thursday'),
        '5' => __('Friday'),
        '6' => __('Saturday'),
        '0' => __('Sunday')
    );
    if ($clocker) {
        
        $str = $day . ' ' . $months[$month] . ' ' . $year . ' ' . $hour . ':' . $minute;
    } else {
        $str = $day . ' ' . $months[$month] . ' ' . $year;
    }
    return $str;
}

/**
 *
 * @param  Short Date
 * @return mixed
 */

function shortdate($str = null)
{
    $day = date('w', strtotime($str));
    $str = preg_split("/[-\\:\\/ ]/", $str); 
    $day = $str[2];
    $month  = $str[1];
    $year = $str[0]; 
    $date = $year.'-'.$month.'-'.$day;
    $months = array(
        "01" => __('Jan'),
        "02" => __('Feb'),
        "03" => __('Mar'),
        "04" => __('Apr'),
        "05" => __('May'),
        "06" => __('Jun'),
        "07" => __('Jul'),
        "08" => __('Aug'),
        "09" => __('Sep'),
        "10" => __('Oct'),
        "11" => __('Nov'),
        "12" => __('Dec'),
    );
    $days = array(
        '1' => __('Monday'),
        '2' => __('Tuesday'),
        '3' => __('Wednesday'),
        '4' => __('Thursday'),
        '5' => __('Friday'),
        '6' => __('Saturday'),
        '0' => __('Sunday')
    );
    if($date == date('Y-m-d')) {
        $str = __('Today');
    }elseif($date == strtotime('-1 day',strtotime(date('Y-m-d')))) {
        $str = __('Yesterday');
    }else{
        $str = $day . ' ' . $months[$month];
    }
    return $str;
}

/**
 *
 * @param  Downloader
 * @return mixed
 */

function downloader($url, $filename)
{
    if (file_exists($filename)) {
        @unlink($filename);
    }
    $fp = fopen($filename, 'w');
    if ($fp) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $result = parse_url($url);
        curl_setopt($ch, CURLOPT_REFERER, $result['scheme'] . '://' . $result['host']);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0');
        $raw = curl_exec($ch);
        curl_close($ch);
        if ($raw) {
            fwrite($fp, $raw);
        }
        fclose($fp);
        if (!$raw) {
            @unlink($filename);
            return false;
        }
        return true;
    }
    return false;
}



/**
 *
 * @param  Json Get
 * @return mixed
 */

function get($data = null, $field = null, $name = null, $parse = true)
{
    if ($name) {
        foreach ($data as $key => $val) {
            if ($val['name'] == $name) {
                $data = $data[$key];
            }
        }
    }
    if (is_string($field) && $field) {
        if ($parse) {
            $fields = explode(".", $field);
        }
        
        if (!empty($fields) && count($fields) > 1) {
            $column = $fields[0];
            
            if (isset($data[$column]) && is_string($column) && $column) {
                $parsedjson = @json_decode($data[$column]);
                
                if ($parsedjson) {
                    array_shift($fields);
                    
                    $val = $parsedjson;
                    foreach ($fields as $name) {
                        if ($name && isset($val->$name)) {
                            $val = $val->$name;
                        } else {
                            $val = null;
                            break;
                        }
                    }
                    
                    return is_string($val) ? trim($val) : $val;
                }
            }
        } else {
            if (isset($data[$field])) {
                return is_string($data[$field]) ? trim($data[$field]) : $data[$field];
            }
        }
    }
    
    return null;
}

function ads($data,$id = null,$class = null) {
    $ArrayId        = array_search($id, array_column($data, 'id'));
    $Row            = $data["$ArrayId"];
    $html = null; 
    if($Row['id']) {
        $JsonData       = json_decode($Row['ads_data'], true);  

        if ($Row['type'] == 'image') {
            if($Row['id'] != 5) {
                $html = '<a href="'.$JsonData['link'].'" rel="noreferrer" class="ads-embed '.$class.'" target="_blank" rel="nofollow"><img src="'.UPLOAD.'/ads/'.$JsonData['image'].'" alt="Reklam"></a>';
            } else {
                $html = '<a href="'.$JsonData['link'].'" rel="noreferrer" class="ads-embed '.$class.'" target="_blank" rel="nofollow" style="background-image: url(\''.UPLOAD.'/ads/'.$JsonData['image'].'\')"></a>';
            }
        } elseif ($Row['type'] == 'code') {
            $html = '<div class="ads-embed">'.htmlspecialchars_decode($Row['ads_code']).'</div>';
        }
    }
    return $html;

}
function timeago($date)
{
    $timestamp = strtotime($date);
    
    $strTime = array(
        __('sec'),
        __('min'),
        __('hour'),
        __('day'),
        __('month'),
        __('year')
    );
    $length  = array(
        "60",
        "60",
        "24",
        "30",
        "12",
        "10"
    );
    
    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }
        
        $diff = round($diff);
        return $diff . " " . $strTime[$i] . " ".__('ago');
    }
}

/**
 *
 * @param  Word Limit
 * @return mixed
 */

function wordlimit($deger, $krktr = 80)
{
    $deger  = Input::cleaner($deger);
    $toplam = strlen($deger);
    if ($toplam > $krktr) {
        $deger = mb_substr($deger, 0, $krktr, 'UTF-8') . '..';
    }
    return $deger;
}

/**
 *
 * @param Minify
 * @return mixed
 */
function buffer($buffer){

        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(': ', ':', $buffer);
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

        return $buffer;
}
/**
 *
 * @param Post Link
 * @return mixed
 */
function post($id, $self = null,$type = null) {
    if($type == 'movie') {
        return APP.'/movie/'.$self.'-'.$id;
    } elseif($type == 'serie') {
        return APP.'/curso/'.$self.'-'.$id;
    }
}

/**
 *
 * @param Episode Link
 * @return mixed
 */
function episode($id, $self = null,$season = null,$episode = null) {
    return APP.'/curso/'.$self.'-'.$id.'-'.$season.'-season-'.$episode.'-episode';
}

/**
 *
 * @param Channel Link
 * @return mixed
 */
function channel($id, $self = null) {
    return APP.'/tv-channel/'.$self.'-'.$id;
}

/**
 *
 * @param Actor Link
 * @return mixed
 */
function actor($id, $self = null) {
    return APP.'/actor/'.$self.'-'.$id;
}

/**
 *
 * @param Discussion Link
 * @return mixed
 */
function discussion($id, $self = null) {
    return APP.'/discussion/'.$self.'-'.$id;
}

/**
 *
 * @param Collection Link
 * @return mixed
 */
function collection($id, $self = null) {
    return APP.'/collection/'.$id;
}
/**
 *
 * @param Page Link
 * @return mixed
 */
function page($id, $self = null) {
    return APP.'/page/'.$self;
}
/**
 *
 * @param Page Link
 * @return mixed
 */
function profile($id, $self = null) {
    return APP.'/profile/'.$self;
}