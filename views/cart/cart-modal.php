<?php if (!empty($session)) : ?>
    <div class="table-responsive">
        <!--<div class="table table-hover table-striped">-->
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>
                            <!--<button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>-->
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= $item['img']?></td>
                        <td><?= $item['name']?></td>
                        <td><?= $item['qty']?></td>
                        <td><?= $item['price']?></td>
                        <td><span class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="4">Итого:</td>
                        <td><?= $session['cart.qty']?></td>
                    </tr>
                    <tr>
                        <td colspan="4">На сумму:</td>
                        <td><?= $session['cart.sum']?></td>
                    </tr>
                </tbody>
            </table>
        <!--</div>-->
    </div>
<?php else: ?>
    <h2>Корзина пуста!</h2>
<?php endif; ?>

