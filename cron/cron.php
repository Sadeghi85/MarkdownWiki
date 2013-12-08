<?php

$random_hash = md5(date('r', time()));

$attachment = chunk_split(base64_encode(file_get_contents('/var/www/app/storage/cache/markdown-wiki.latest.sql.gz')));

$message = "--PHP-mixed-{$random_hash}\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-{$random_hash}\"\r\n\r\n--PHP-alt-{$random_hash}\r\nContent-Type: text/plain; charset=\"iso-8859-1\"\r\nContent-Transfer-Encoding: 7bit\r\n\r\nMarkdown-Wiki Backup\r\n\r\n--PHP-alt-{$random_hash}--\r\n\r\n--PHP-mixed-{$random_hash}\r\nContent-Type: application/zip; name=\"markdown-wiki.latest.sql.gz\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment\r\n\r\n{$attachment}\r\n--PHP-mixed-{$random_hash}--";

mail('sadeghi85@hotmail.com', 'pagoda test', $message, "Content-Type: multipart/mixed; boundary=\"PHP-mixed-{$random_hash}\"");

exit;

