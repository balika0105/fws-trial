-- Próbafeladathoz mellékelt SQL DB lekérdezés megoldása
CREATE SCHEMA `probafeladat` DEFAULT CHARACTER SET utf8mb4;
USE `probafeladat`;

-- Mellékelt SQL fájl importálása ITT


-- Lekért csomag száma: #2264
-- Lekért dátum: 2023-12-01

SELECT SUM(sub.price) AS package_sum
FROM(
SELECT `price_history`.`price` FROM price_history
INNER JOIN `product_package_contents` ON `price_history`.`product_id` = `product_package_contents`.`product_id`
WHERE `product_package_contents`.`product_package_id` = 2264
GROUP BY `product_package_contents`.`product_id`
ORDER BY ABS(DATEDIFF (`price_history`.`updated_at`, 2023-12-01)) ASC)
AS sub;