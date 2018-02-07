<?php if (!empty($session)) : ?>
    <div class="table-responsive">
        <div class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </th>
                </tr>
            </thead>
        </div>
    </div>
<?php else: ?>
    <h2>Корзина пуста!</h2>
<?php endif; ?>

