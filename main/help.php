<?php
  require_once 'header.php';
  require_once '../config/config.php';
?>

<title>Help | <?php echo $config['web']['name']; ?></title>

<style>

  .more {
    display: none;
  }

</style>

<div class="container">

  <table class="table table-striped table-hover table-condensed">
    <caption><h3>一 样本信息</h3></caption>
    <thead>
      <tr>
        <th>测序类型</th><th>样本数</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>WES</td><td>542</td></tr>
      <tr><td>WGS</td><td>2827</td></tr>
    </tbody>
  </table>

  <table class="table table-striped table-hover table-condensed">
    <caption><h3>二 表头说明(部分)</h3></caption>
    <thead>
      <tr>
        <th>表头</th><th>说明</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>NOVO_WE(G)S_AN</td><td>NovoZhonghua数据库中，WE(G)S样本的Alleles总数（等于样本数的2倍）</td></tr>
      <tr><td>NOVO_WE(G)S_AF</td><td>NovoZhonghua数据库中，WE(G)S样本的突变频率（AC/AN）</td></tr>
      <tr><td>NOVO_WE(G)S_HOM_AF</td><td>NovoZhonghua数据库中，WE(G)S样本的纯合突变频率（Hom_AC/AN）</td></tr>
      <tr><td>NOVO_WE(G)S_HET_AF</td><td>NovoZhonghua数据库中，WE(G)S样本的杂合突变频率（Het_AC/AN）</td></tr>
      <tr><td>NOVO_WE(G)S_HWE</td><td>NovoZhonghua数据库中，WE(G)S样本突变<a target="_blank" 
        href="https://www.ncbi.nlm.nih.gov/pubmed/15789306">哈温平衡</a>的P值</td></tr>

      <tr><td><a class="btn btn-default" onclick="$('.more').fadeToggle();">
        查看更多 <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
      </a></td></tr>

      <tr class="more"><td>to be added ...</td><td>...</td></tr>


    </tbody>
  </table>
</div>