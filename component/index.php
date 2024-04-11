<?php
include("../database.php");

$id = $_GET['id'];
$select = "select * from orders where order_id = '$id'";
$result = $conn->query($select);
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css_new/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <div>
    <div class="py-4" style="width: 60%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
      <div class="px-14 py-6">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-full align-top">
                <div>
                  <img src="https://menkoff.com/assets/brand-sample.png" class="h-12" />
                </div>
              </td>

              <td class="align-top">
                <div class="text-sm">
                  <table class="border-collapse border-spacing-0">
                    <tbody>
                      <tr>
                        <td class="border-r pr-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Date</p>
                            <p class="whitespace-nowrap font-bold text-main text-right"><?php echo $row['create_at'] ?></p>
                          </div>
                        </td>
                        <td class="pl-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Invoice #</p>
                            <p class="whitespace-nowrap font-bold text-main text-right"><?php echo $row['order_id'] ?></p>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-slate-100 px-14 py-6 text-sm">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-1/2 align-top">
                <div class="text-sm text-neutral-600">
                  <p class="font-bold" style="font-size: 25px;">The Pizzeria</p>
                  <span style="font-weight: bold; font-size: 15px">User id: <p class="user_id"><?php echo $row['user_id'] ?></p></span>
                  <span style="font-weight: bold; font-size: 15px ">Họ tên: <p class="hoten"><?php echo $row['hoten'] ?></p></span>
                  <span style="font-weight: bold; font-size: 15px ">Số điện thoại: <p class="sdt"><?php echo $row['sdt'] ?></p></span>
                  <span style="font-weight: bold; font-size: 15px ">Địa chỉ: <p class="diachi"><?php echo $row['diachi'] ?></p></span>
                  <span style="font-weight: bold; font-size: 15px ">Email: <p class="emai"></p><?php echo $row['email'] ?></span>
                  <span style="font-weight: bold; font-size: 15px ">Ghi chú: <p class="note"><?php echo $row['note'] ?></p></span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <table class="w-full border-collapse border-spacing-0">
          <thead>
            <tr>
              <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">#</td>
              <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Tên sản phẩm</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Ảnh</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Tổng tiền.</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Số lương đặt</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border-b py-3 pl-3 order_id"><?php echo $row['order_id'] ?></td>
              <td class="border-b py-3 pl-2 food_order"><?php echo $row['food_order'] ?></td>
              <td class="border-b py-3 pl-2 text-right"><img class="imgfood" src="../foodimage/<?php echo $row['image'] ?>" style="height: 80px; width: 80px;" alt=""></td>
              <td class="border-b py-3 pl-2 text-center total_price">$ <?php echo $row['total_price'] ?></td>
              <td class="border-b py-3 pl-2 text-center number_order"><?php echo $row['number_order'] ?></td>
            </tr>
          </tbody>
        </table>
        <div colspan="7" class="mt-2">
          <table class="w-full border-collapse border-spacing-0">
            <tbody>
              <tr>
                <td class="w-full"></td>
                <td>
                  <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                      <tr>
                        <td class="bg-main p-3">
                          <div class="whitespace-nowrap font-bold text-white">Total:</div>
                        </td>
                        <td class="bg-main p-3 text-right">
                          <div class="whitespace-nowrap font-bold text-white total_price">$ <?php echo $row['total_price'] ?></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <div style="width: 100%; text-align: end;" class="mt-2">
          <a href="../controller_old/pdf.php" class="btn-pdf btn btn-danger" style="color: white; text-decoration: none">Convert to PDF file <i class="fa-solid fa-file-pdf"></i> </a>
        </div> -->
      </div>



      <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
        Supplier Company
        <span class="text-slate-300 px-2">|</span>
        info@company.com
        <span class="text-slate-300 px-2">|</span>
        +1-202-555-0106
      </footer>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var order_id = document.querySelector('.order_id')
      var user_id = document.querySelector('.user_id')
      var food_order = document.querySelector('.food_order')
      var time = document.querySelector('.time')
      var imgfood = document.querySelector('.imgfood')
      var total_price = document.querySelector('.total_price')
      var number_order = document.querySelector('.number_order')
      var hoten = document.querySelector('.hoten')
      var sdt = document.querySelector('.sdt')
      var diachi = document.querySelector('.diachi')
      var email = document.querySelector('.email')
      var note = document.querySelector('.note')
      var cookieData = document.cookie;
      console.log(imgfood);
      function getCookieValue(cookieName) {
        var name = cookieName + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var cookieArray = decodedCookie.split(';');
        for (var i = 0; i < cookieArray.length; i++) {
          var cookie = cookieArray[i].trim();
          if (cookie.indexOf(name) == 0) {
            return cookie.substring(name.length, cookie.length);
          }
        }
        return "";
      }
      var cookie = getCookieValue('orderInfo');
      var cookieorder = JSON.parse(cookie)
      console.log(cookieorder['hoten']);
      order_id.textContent = cookieorder['order_id']
      user_id.textContent = cookieorder['user_id']
      food_order.textContent = cookieorder['food_order']
      time.textContent = cookieorder['time']
      imgfood.src = `../foodimage/${cookieorder['order_id']}`
      total_price.textContent = cookieorder['total_price']
      number_order.textContent = cookieorder['number_order']
      hoten.textContent = cookieorder['hoten']
      sdt.textContent = cookieorder['sdt']
      diachi.textContent = cookieorder['diachi']
      email.textContent = cookieorder['email']
      note.textContent = cookieorder['note']
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>