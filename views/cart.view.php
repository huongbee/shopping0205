<!-- Main Container -->
<section class="main-container col1-layout">
  <div class="main container">
    <div class="col-main">
      <div class="cart">

        <div class="page-content page-order">
          <div class="page-title">
            <h2>Giỏ hàng của bạn</h2>
          </div>


          <div class="order-detail-content">
            <div class="table-responsive">
              <table class="table table-bordered cart_summary">
                <thead>
                  <tr>
                    <th class="cart_product">Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá - Giá khuyến mãi</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th class="action"><i class="fa fa-trash-o"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $cart = $data['cart'];
                  foreach($cart->items as $product):?>
                  <tr>
                    <td class="cart_product"><a href="#"><img src="public/source/images/products-images/<?=$product['item']->image?>" alt="<?=$product['item']->name?>"></a></td>
                    <td class="cart_description">
                      <p class="product-name"><a href="<?=$product['item']->url?>.html"><?=$product['item']->name?></a></p>
                    </td>
                    <td class="price">
                      <?php if($product['price'] != $product['promotionPrice']):?>
                      <p style="color:#333e48; font-weight:normal">
                        <del>
                          <?=number_format($product['item']->price)?>
                        </del>
                      </p>
                      <?php endif?>
                      <p>
                        <?=number_format($product['item']->promotion_price)?>
                      </p>
                    </td>
                    <td class="qty"><input class="form-control input-sm" type="text" value="<?=$product['qty']?>"></td>
                    <td class="price">
                    <?php if($product['price'] != $product['promotionPrice']):?>
                      <p style="color:#333e48; font-weight:normal">
                        <del>
                          <?=number_format($product['price'])?>
                        </del>
                      </p>
                      <?php endif?>
                      <p>
                        <?=number_format($product['promotionPrice'])?>
                      </p>
                    </td>
                    <td class="action"><a href="#"><i class="icon-close"></i></a></td>
                  </tr>
                  <?php endforeach?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" rowspan="2"></td>
                    <td colspan="3">Tổng tiền</td>
                    <td colspan="2"><?=number_format($cart->totalPrice)?></td>
                  </tr>
                  <tr>
                    <td colspan="3"><strong>Thanh toán</strong></td>
                    <td colspan="2"><strong><?=number_format($cart->promtPrice)?></strong></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="cart_navigation">
              <a class="continue-btn" href="./"><i class="fa fa-arrow-left"> </i>&nbsp; Tiếp tục mua sắm</a>
              <a class="checkout-btn" href="./checkout.php"><i class="fa fa-check"></i> Đặt hàng</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>