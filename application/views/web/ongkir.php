<?php if(count($couriers) > 0){ ?>
    <select onchange="checkTotal()" class="form-control" id="cost" name="cost">
        <?php foreach ($couriers as $courier) { 
            $ongkir = toRp($courier->cost[0]->value);
            $totalAll = $couriername."-".$courier->service.":".$courier->cost[0]->value.":".toRp($courier->cost[0]->value + $total);
         ?>
            <option value="<?=$totalAll?>"><?="$courier->service: $ongkir ({$courier->cost[0]->etd} Days)"; ?></option>
        <?php } ?>
    </select>
<?php } else { ?>
    <select onchange="checkTotal()" class="form-control" id="cost" name="cost">
        <option value="<?="self:free:".toRp($total)?>">Gratis</option>
    </select>
<?php } ?>

