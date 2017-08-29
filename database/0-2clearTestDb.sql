SET FOREIGN_KEY_CHECKS=0;

TRUNCATE TABLE reporting_test.admin;
TRUNCATE TABLE reporting_test.affiliate;
TRUNCATE TABLE reporting_test.affiliate_status;
TRUNCATE TABLE reporting_test.cancellation_track;
TRUNCATE TABLE reporting_test.click_track;
TRUNCATE TABLE reporting_test.conversion_track;

ALTER TABLE reporting_test.affiliate DROP FOREIGN KEY fk_affiliate_status_affiliate_id_status;
ALTER TABLE reporting_test.cancellation_track DROP FOREIGN KEY fk_cancellation_track_affiliate_affiliate_id;
ALTER TABLE reporting_test.click_track DROP FOREIGN KEY fk_click_track_affiliate_affiliate_id;
ALTER TABLE reporting_test.conversion_track DROP FOREIGN KEY fk_conversion_track_affiliate_affiliate_id;

SET FOREIGN_KEY_CHECKS=1;