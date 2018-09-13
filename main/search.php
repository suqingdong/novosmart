<?php

  $dbname = '../data/db/data.db';

  if ( $_SESSION['username'] == 'demo' ) {
    $dbname = '../data/db/demo.db';
  }

  require_once '../utils/connect_db.php';

  $db = connect($dbname);

  $row = array();

  $terms = $_GET['term'];
  $terms = explode("\r\n", $terms);

  // 多行依次处理
  foreach ($terms as $term) 
  {
    // 去除每行两端的空白字符
    $term = trim($term);

    // 分割每行成数组
    $term_list = preg_split('/[,;:-]|\t|(\ )+/', $term);

    // 根据数组长度进行不同查询
    $term_len = count($term_list);

    if ( $term_len == 1 )
    {
      if ( preg_match('/^rs\d+$/', $term) )
      {
        $sql = sprintf("SELECT * FROM novodb WHERE rsid='%s'", $term);
      } else {
        $sql = sprintf("SELECT * FROM novodb WHERE genename='%s'", strtoupper($term));
      }
    } else if ( $term_len == 2 ) {
      $sql = sprintf(
        "SELECT * FROM novodb WHERE chrom='%s' and pos='%s'",
        $term_list[0], $term_list[1]);
    } else if ( $term_len == 3 ) {
      $sql = sprintf(
        // 使用CAST函数进行类型转换
        "SELECT * FROM novodb WHERE chrom='%s' and CAST(pos AS INT)>=%s and CAST(pos AS INT)<=%s",
        $term_list[0], $term_list[1], $term_list[2]);
    } else if ( $term_len == 4 ) {
      $sql = sprintf(
        "SELECT * FROM novodb WHERE chrom='%s' and pos='%s' and ref='%s' and alt='%s'",
        $term_list[0], $term_list[1], $term_list[2], $term_list[3]);
    }

    // print_r("'".$sql."'");
    $result = $db->query($sql);

    if ( $result )
    {
      while ( $res = $result->fetchArray(SQLITE3_ASSOC) )
      {
      // 用于存储去重的全部结果
        if ( ! in_array($res, $row) )
        {
          array_push($row, $res);
        }
      }
    }
  } 

  $db->close();
?>
