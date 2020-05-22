<?php

$_GLOBAL["defaultPageSize"] = 4;

session_start();
$currentUser = isset($_SESSION["user"])?$_SESSION["user"]:null;

$theme = isset($_GET["theme"])?$_GET["theme"]:"";
if(!$theme){
  $theme = isset($_COOKIE["theme"])?$_COOKIE["theme"]:null;
}else{
  setcookie("theme",$theme);
}
if(!$theme) $theme = "default";

function makePageUrl($pageIndex){
    $querystring="pageIndex=$pageIndex";
    foreach($_GET as $k =>$v){
        if($k==="pageIndex"){
            continue;
        }
        $querystring .= "&$k=$v";
    }
    return $querystring;
}

function getParam($name){
  $value = isset($_GET[$name])?trim($_GET[$name]):(isset($_POST[$name])?$_POST[$name]:"");
  $value = str_replace("'","'",$value);
  return $value;
}
function createDb(){
  return new mysqli("localhost","root","","myblog");
}

function getPageInfo($tb,$where,$order,$pageIndex,$pageSize){
  $items=[];

  $startNo = ($pageIndex-1)*$pageSize +1;
  $sql = "select * from $tb";
  if($where) $sql .=" where $where";
  if($order) $sql .=" order by $order";
  $itemsSql = $sql ." limit $startNo,$pageSize";
  $conn = createDb(); 
  $rs= $conn->query($itemsSql);
  if($conn->error) die($conn->error);
  while($row = $rs->fetch_assoc()){
      $items[] = $row;
  }
  $rs->close();
  
  $countSql = "select Count(*) as C from $tb";
  if($where) $countSql .=" where $where";
  $rs = $conn->query($countSql);
  $recordCount = $rs->fetch_assoc()["C"];
  $pageCount =ceil($recordCount/$pageSize);
  return[
      "items"=>$items,
      "recordCount"=>$recordCount,
      "pageCount"=>$pageCount
  ];
}
?>

