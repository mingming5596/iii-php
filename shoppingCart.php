<script>
function jsonToQueryString(json) {
  return '?' +
    Object.keys(json).map(function(key) {
      return encodeURIComponent(key) + '=' +
            encodeURIComponent(json[key]);
    }).join('&');
}

function handleAdd(pid, e) {
  const qtyE = e.previousSibling;
  const qty = qtyE.value;

  if (qty.match(/^\d+$/)) {
    // add to cart
    var params = jsonToQueryString({
      type: 'add',
      pid,
      qty
    });

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          const res = JSON.parse(xhr.response);
          if (res.status === 'success') {
            alert('加入購物車成功');
            qtyE.value = '';
          }
        }
    }
    xhr.open('GET', 'changeCart.php' + params);
    xhr.send();
  }
}
</script>

<?
include_once 'sql.php';

$sql = "SELECT * FROM product";
$result = $mysqli->query($sql);
?>

<table border="1" width="100%">
  <tr>
    <th>id</th>
    <th>pname</th>
    <th>price</th>
    <th>數量</th>
  </tr>
  <?php
    while ($product = $result->fetch_object()) {
      echo '<tr>';
      echo "<td>{$product->id}</td>";
      echo "<td>{$product->pname}</td>";
      echo "<td>{$product->price}</td>";
      echo "<td>";
      echo "<input type='text' />";
      echo "<input type='button' value='Add To Cart' onclick='handleAdd({$product->id}, this)' />";
      echo "</td>";
      echo '</tr>';
    }
  ?>
</table>