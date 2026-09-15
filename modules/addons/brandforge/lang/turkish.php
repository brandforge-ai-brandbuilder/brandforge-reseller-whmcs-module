<?php
/**
 * BrandForge Package Sync — Addon Admin Language File (Turkish)
 *
 * AI-drafted first pass — needs a native Turkish speaker's review before
 * being treated as production-ready. See lang/english.php for the full
 * key reference and how WHMCS loads this file.
 */

if (!defined('WHMCS')) {
    die('Access denied.');
}

$_ADDONLANG['bf_page_title']           = 'BrandForge — Paket Senkronizasyonu';
$_ADDONLANG['bf_sync_packages']        = 'Paketleri Senkronize Et';
$_ADDONLANG['bf_syncing']              = 'Senkronize ediliyor…';
$_ADDONLANG['bf_create_all_products']  = 'Tüm Ürünleri Oluştur';
$_ADDONLANG['bf_creating']             = 'Oluşturuluyor…';
$_ADDONLANG['bf_reset_everything']     = 'Her Şeyi Sıfırla';
$_ADDONLANG['bf_reset_confirm']        = "Bu işlem tüm paket/hizmet eşleştirme verilerini temizler ve sunucu kaydını kaldırır.\n\nWHMCS ürünleriniz korunur — kurulumu yeniden çalıştırmak, kopya oluşturmadan onları yeniden bağlar.\n\nDevam edilsin mi?";

// Status bar
$_ADDONLANG['bf_status_api_credentials']  = 'API Kimlik Bilgileri';
$_ADDONLANG['bf_status_saved']            = 'Kaydedildi';
$_ADDONLANG['bf_status_not_set']          = 'Ayarlanmadı — önce ayarları kaydedin';
$_ADDONLANG['bf_status_server_record']    = 'Sunucu Kaydı';
$_ADDONLANG['bf_status_configured']       = 'Yapılandırıldı';
$_ADDONLANG['bf_status_not_created']      = 'Oluşturulmadı';
$_ADDONLANG['bf_status_packages']         = 'Paketler';
$_ADDONLANG['bf_status_not_synced']       = 'Senkronize edilmedi';
$_ADDONLANG['bf_status_synced']           = 'senkronize edildi';
$_ADDONLANG['bf_status_products']         = 'Ürünler';
$_ADDONLANG['bf_status_ready']            = 'hazır';
$_ADDONLANG['bf_status_linked']           = 'bağlandı';

// One-Click Setup wizard
$_ADDONLANG['bf_wizard_title']       = '🚀 Tek Tıkla Kurulum';
$_ADDONLANG['bf_wizard_intro']       = 'API kimlik bilgileriniz eklenti ayarlarında kayıtlı. Her şeyi otomatik olarak yapılandırmak için aşağıdaki düğmeye tıklayın — teknik bir adım gerekmez.';
$_ADDONLANG['bf_wizard_step_server'] = 'API kimlik bilgilerinizi kullanarak bir WHMCS sunucu kaydı oluşturur';
$_ADDONLANG['bf_wizard_step_pull']   = 'Tüm Godmode paketlerinizi çeker';
$_ADDONLANG['bf_wizard_step_create'] = 'Her paket için bir WHMCS ürünü oluşturur';
$_ADDONLANG['bf_wizard_step_link']   = 'Tüm ürünleri BrandForge modülüne, tamamen yapılandırılmış şekilde bağlar';
$_ADDONLANG['bf_wizard_need_creds']  = 'Kurulumu çalıştırmadan önce lütfen <strong>Godmode API URL</strong> ve <strong>API Anahtarınızı</strong> eklenti ayarlarına (Eklenti Modülleri sayfasındaki Yapılandır düğmesi) kaydedin.';
$_ADDONLANG['bf_wizard_unavailable'] = 'Kurulum Kullanılamıyor — Önce Kimlik Bilgilerini Kaydedin';
$_ADDONLANG['bf_wizard_run']         = '🚀 Tek Tıkla Kurulumu Çalıştır';
$_ADDONLANG['bf_wizard_confirm']     = 'Bu işlem bir sunucu kaydı oluşturacak, paketleri senkronize edecek ve otomatik olarak WHMCS ürünleri oluşturacak. Devam edilsin mi?';

// Next steps / setup complete
$_ADDONLANG['bf_next_complete']  = '✅ Kurulum tamamlandı.';
$_ADDONLANG['bf_next_body']      = '<strong>Ürünler/Hizmetler → Ürünler/Hizmetler → [Ürün] → Fiyatlandırma</strong> altında her ürüne fiyat ekleyin, ardından müşterileriniz sipariş verebilir. Godmode yeni paketler eklediğinde, <strong>Paketleri Senkronize Et</strong> ve ardından <strong>Tüm Ürünleri Oluştur</strong> düğmesine tıklayın.';

// Stats
$_ADDONLANG['bf_stat_total']   = 'Toplam';
$_ADDONLANG['bf_stat_linked']  = 'Bağlı';
$_ADDONLANG['bf_stat_pending'] = 'Beklemede';

// Package table
$_ADDONLANG['bf_table_no_packages']   = 'Henüz senkronize edilmiş paket yok. Godmode\'dan çekmek için <strong>Paketleri Senkronize Et</strong> düğmesine tıklayın.';
$_ADDONLANG['bf_col_package_name']    = 'Paket Adı';
$_ADDONLANG['bf_col_plan_id']         = 'Plan Kimliği';
$_ADDONLANG['bf_col_plan_id_note']    = '(Godmode için)';
$_ADDONLANG['bf_col_godmode_id']      = 'Godmode Kimliği';
$_ADDONLANG['bf_col_product_id']      = 'Ürün Kimliği';
$_ADDONLANG['bf_col_product_id_note'] = '(Godmode için)';
$_ADDONLANG['bf_col_whmcs_product']   = 'WHMCS Ürünü';
$_ADDONLANG['bf_col_status']          = 'Durum';
$_ADDONLANG['bf_col_actions']         = 'İşlemler';
$_ADDONLANG['bf_status_synced_label'] = 'Senkronize Edildi';
$_ADDONLANG['bf_status_pending_label']= 'Beklemede';
$_ADDONLANG['bf_action_sync']         = 'Senkronize Et';
$_ADDONLANG['bf_action_sync_title']   = 'Bu paketi Godmode\'dan yeniden çek';
$_ADDONLANG['bf_action_auto_create']  = 'Otomatik Oluştur';
$_ADDONLANG['bf_action_auto_create_title'] = 'Yeni bir WHMCS ürünü oluştur ve bağla';
$_ADDONLANG['bf_action_link']         = 'Bağla';
$_ADDONLANG['bf_action_link_placeholder'] = 'Mevcut ürünü bağla…';
$_ADDONLANG['bf_action_unlink']       = 'Bağlantıyı Kaldır';
$_ADDONLANG['bf_action_unlink_confirm'] = '"%s" için ürün bağlantısı kaldırılsın mı?';
$_ADDONLANG['bf_mapping_footer']      = 'Yerel eşlemede %d paket — son güncelleme: %s';
$_ADDONLANG['bf_never']               = 'Asla';

// Loading overlay
$_ADDONLANG['bf_overlay_title']  = 'BrandForge kuruluyor…';
$_ADDONLANG['bf_overlay_sub']    = 'Bu işlem yaklaşık 10–30 saniye sürer. Lütfen bu sayfayı kapatmayın.';
$_ADDONLANG['bf_overlay_step1']  = 'Godmode API\'ye bağlanılıyor';
$_ADDONLANG['bf_overlay_step2']  = 'Sunucu kaydı oluşturuluyor';
$_ADDONLANG['bf_overlay_step3']  = 'Paketler Godmode\'dan senkronize ediliyor';
$_ADDONLANG['bf_overlay_step4']  = 'WHMCS ürünleri oluşturuluyor';
$_ADDONLANG['bf_overlay_note']   = 'Kurulum tamamlandığında otomatik olarak yönlendirileceksiniz.';

// Flash / status messages
$_ADDONLANG['bf_flash_invalid_token']   = 'Geçersiz güvenlik jetonu. Lütfen sayfayı yenileyip tekrar deneyin.';
$_ADDONLANG['bf_flash_need_creds']      = 'Kurulumu çalıştırmadan önce Godmode API URL ve API Anahtarı eklenti ayarlarına kaydedilmelidir.';
$_ADDONLANG['bf_flash_setup_complete']  = 'Kurulum tamamlandı! %1$d paket senkronize edildi ve %2$d WHMCS ürünü oluşturuldu. Her ürüne fiyat ekleyin, ardından satışa hazır olacaksınız.';
$_ADDONLANG['bf_flash_errors']          = ' Hatalar: %s';
$_ADDONLANG['bf_flash_created_n']       = '%d ürün oluşturuldu.';
$_ADDONLANG['bf_flash_reset_complete']  = 'Sıfırlama tamamlandı. Eşleme tabloları temizlendi ve sunucu kaydı kaldırıldı. WHMCS ürünleriniz korundu — yeniden bağlamak için Tek Tıkla Kurulumu çalıştırın (kopya oluşturulmayacak).';
$_ADDONLANG['bf_flash_synced_n']        = 'Godmode\'dan %d paket senkronize edildi.';
$_ADDONLANG['bf_flash_package_synced']  = 'Paket başarıyla senkronize edildi.';
$_ADDONLANG['bf_flash_mapping_rebuilt'] = 'Eşleme yeniden oluşturuldu — %d paket senkronize edildi';
$_ADDONLANG['bf_flash_reconnected']     = ', %d mevcut ürün yeniden bağlandı';
$_ADDONLANG['bf_flash_product_linked']  = 'WHMCS ürünü #%1$d "%2$s" oluşturuldu ve bağlandı.';
$_ADDONLANG['bf_flash_linked_to']       = 'Paket, WHMCS ürünü #%d ile bağlandı.';
$_ADDONLANG['bf_flash_link_removed']    = 'Ürün bağlantısı kaldırıldı.';
$_ADDONLANG['bf_flash_unknown_action']  = 'Bilinmeyen işlem.';
$_ADDONLANG['bf_flash_no_package_id']   = 'Paket kimliği belirtilmedi.';
$_ADDONLANG['bf_flash_not_in_table']    = 'Paket yerel tabloda yok. Önce Tümünü Senkronize Et\'i çalıştırın.';
$_ADDONLANG['bf_flash_already_linked']  = 'Bu paket zaten bağlı bir WHMCS ürününe sahip.';
$_ADDONLANG['bf_flash_select_product']  = 'Bağlamak için bir WHMCS ürünü seçin.';
$_ADDONLANG['bf_flash_error_prefix']    = 'Hata: %s';

// Addon settings (Configure page) field labels
$_ADDONLANG['bf_cfg_name']            = 'BrandForge Package Sync';
$_ADDONLANG['bf_cfg_description']     = 'Godmode paketlerini WHMCS ürünleriyle senkronize eder ve provisioning eşleme tablosunu günceller.';
$_ADDONLANG['bf_cfg_api_url']         = 'Godmode API URL';
$_ADDONLANG['bf_cfg_api_url_desc']    = 'Godmode API için temel URL (sonunda eğik çizgi olmadan)';
$_ADDONLANG['bf_cfg_api_key']         = 'Godmode API Anahtarı';
$_ADDONLANG['bf_cfg_api_key_desc']    = 'Tüm Godmode API isteklerinde kullanılan taşıyıcı jeton';
$_ADDONLANG['bf_cfg_debug_mode']      = 'Hata Ayıklama Modu';
$_ADDONLANG['bf_cfg_debug_mode_desc'] = 'Ayrıntılı API günlüklerini WHMCS Modül Günlüğüne yaz';

// Activate / Deactivate lifecycle messages
$_ADDONLANG['bf_activated']        = 'BrandForge Package Sync etkinleştirildi. Paket ve hizmet eşleme tabloları oluşturuldu.';
$_ADDONLANG['bf_activate_failed']  = 'Etkinleştirme başarısız oldu: %s';
$_ADDONLANG['bf_deactivated']      = 'BrandForge Package Sync devre dışı bırakıldı. Eşleme verileri korundu.';
