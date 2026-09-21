<?php

namespace BrandForge;

use WHMCS\Database\Capsule;

/**
 * Looks up a package upgrade the customer has ordered but WHMCS hasn't
 * applied yet. WHMCS only switches a service to the new product once the
 * upgrade invoice is paid, so until then the client area keeps showing the
 * old plan — this lets the dashboard explain why.
 */
class PendingUpgrade
{
    /**
     * @return array{package_name:string, invoice_id:int, invoice_ref:string}|null
     *         invoice_id is 0 when there is no unpaid invoice (e.g. paid, awaiting processing).
     */
    public static function forService(int $serviceId): ?array
    {
        try {
            $upgrade = Capsule::table('tblupgrades')
                ->where('relid', $serviceId)
                ->where('type', 'package')
                ->where('status', 'Pending')
                ->orderBy('id', 'desc')
                ->first();

            if (!$upgrade) {
                return null;
            }

            // newvalue is "productid,billingcycle"
            $newProductId = (int) explode(',', (string) $upgrade->newvalue)[0];
            $product      = Capsule::table('tblproducts')->where('id', $newProductId)->first();
            if (!$product) {
                return null;
            }

            $invoice = Capsule::table('tblinvoiceitems')
                ->join('tblinvoices', 'tblinvoices.id', '=', 'tblinvoiceitems.invoiceid')
                ->where('tblinvoiceitems.type', 'Upgrade')
                ->where('tblinvoiceitems.relid', (int) $upgrade->id)
                ->where('tblinvoices.status', 'Unpaid')
                ->select('tblinvoices.id', 'tblinvoices.invoicenum')
                ->first();

            return [
                'package_name' => (string) $product->name,
                'invoice_id'   => $invoice ? (int) $invoice->id : 0,
                'invoice_ref'  => $invoice ? ((string) ($invoice->invoicenum ?: $invoice->id)) : '',
            ];
        } catch (\Exception $e) {
            // Never let a lookup failure break the dashboard.
            return null;
        }
    }
}
