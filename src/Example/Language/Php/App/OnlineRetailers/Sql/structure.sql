#电商系统中常用的表结构
#商品表，流水表，订单表，购物车表，用户表，sku表


SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods`  (
                          `goods_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品id',
                          `goods_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品名称',
                          `goods_state` tinyint(4) NOT NULL DEFAULT 1 COMMENT '商品状态（1.正常0下架）',
                          `category_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品分类id,逗号隔开',
                          `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格（取第一个sku）',
                          `goods_stock` int(11) NOT NULL DEFAULT 0 COMMENT '商品库存（总和）',
                          `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否已经删除',
                          `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                          `modify_time` int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
                          `sale_num` int(11) NOT NULL DEFAULT 0 COMMENT '销量',
                          `sku_id` int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
                          `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
                          PRIMARY KEY (`goods_id`) USING BTREE,
                          INDEX `IDX_ns_goods_category_id`(`category_id`) USING BTREE,
                          INDEX `IDX_ns_goods_is_delete`(`is_delete`) USING BTREE,
                          INDEX `IDX_ns_goods_sku_id`(`sku_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES (1, '海蓝之家男装T恤', 1, '52', 50.00, 100, 0, 0, 0, 0, 0, 0);

-- ----------------------------
-- Table structure for goods_cart
-- ----------------------------
DROP TABLE IF EXISTS `goods_cart`;
CREATE TABLE `goods_cart`  (
                               `cart_id` int(11) NOT NULL AUTO_INCREMENT,
                               `member_id` int(11) NOT NULL DEFAULT 0 COMMENT '会员id',
                               `sku_id` int(11) NOT NULL DEFAULT 0 COMMENT 'sku_id',
                               `num` int(11) NOT NULL DEFAULT 0 COMMENT '数量',
                               PRIMARY KEY (`cart_id`) USING BTREE,
                               INDEX `IDX_ns_goods_cart_member_id`(`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = ' 购物车' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_category
-- ----------------------------
DROP TABLE IF EXISTS `goods_category`;
CREATE TABLE `goods_category`  (
                                   `category_id` int(11) NOT NULL AUTO_INCREMENT,
                                   `category_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
                                   `pid` int(11) NOT NULL DEFAULT 0 COMMENT '分类上级',
                                   `level` int(11) NOT NULL DEFAULT 0 COMMENT '层级',
                                   `is_show` int(11) NOT NULL DEFAULT 0 COMMENT '是否显示（0显示  -1不显示）',
                                   `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
                                   PRIMARY KEY (`category_id`) USING BTREE,
                                   INDEX `pid_level`(`pid`, `level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = ' 商品分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of goods_category
-- ----------------------------
INSERT INTO `goods_category` VALUES (1, '玩具', 0, 1, 0, 0);
INSERT INTO `goods_category` VALUES (2, '电子', 0, 1, 0, 0);
INSERT INTO `goods_category` VALUES (3, '服装', 0, 1, 0, 0);
INSERT INTO `goods_category` VALUES (4, '食品', 0, 1, 0, 0);
INSERT INTO `goods_category` VALUES (5, '首饰', 0, 1, 0, 0);
INSERT INTO `goods_category` VALUES (30, '0-3岁玩具', 1, 2, 0, 0);
INSERT INTO `goods_category` VALUES (31, '3-6岁玩具', 1, 2, 0, 0);
INSERT INTO `goods_category` VALUES (32, '6-9岁玩具', 1, 2, 0, 0);
INSERT INTO `goods_category` VALUES (33, '电脑', 2, 2, 0, 0);
INSERT INTO `goods_category` VALUES (34, '电视', 2, 2, 0, 0);
INSERT INTO `goods_category` VALUES (35, '笔记本', 2, 2, 0, 0);
INSERT INTO `goods_category` VALUES (36, '电纸书', 2, 2, 0, 0);
INSERT INTO `goods_category` VALUES (37, '男装', 3, 2, 0, 0);
INSERT INTO `goods_category` VALUES (38, '女装', 3, 2, 0, 0);
INSERT INTO `goods_category` VALUES (40, '甜食', 4, 2, 0, 0);
INSERT INTO `goods_category` VALUES (41, '熟食', 4, 2, 0, 0);
INSERT INTO `goods_category` VALUES (42, '手镯', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (43, '项链', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (44, '耳环', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (45, '脚链', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (46, '手链', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (47, '戒指', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (48, '项圈', 5, 2, 0, 0);
INSERT INTO `goods_category` VALUES (49, '联想', 33, 3, 0, 0);
INSERT INTO `goods_category` VALUES (50, '小米', 33, 3, 0, 0);
INSERT INTO `goods_category` VALUES (51, '戴尔', 33, 3, 0, 0);
INSERT INTO `goods_category` VALUES (52, '海澜之家', 37, 3, 0, 0);
INSERT INTO `goods_category` VALUES (53, '优衣库', 37, 3, 0, 0);
INSERT INTO `goods_category` VALUES (54, '国人西服', 37, 3, 0, 0);
INSERT INTO `goods_category` VALUES (55, '蛋挞', 40, 3, 0, 0);
INSERT INTO `goods_category` VALUES (56, '蛋糕', 40, 3, 0, 0);
INSERT INTO `goods_category` VALUES (57, '冰激凌', 40, 3, 0, 0);
INSERT INTO `goods_category` VALUES (58, '奶油', 40, 3, 0, 0);

-- ----------------------------
-- Table structure for goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `goods_sku`;
CREATE TABLE `goods_sku`  (
                              `sku_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品sku_id',
                              `goods_id` int(11) NOT NULL DEFAULT 0 COMMENT '商品id',
                              `sku_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品sku名称',
                              `sku_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品sku编码',
                              `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'sku单价',
                              `stock` int(11) NOT NULL DEFAULT 0 COMMENT '商品sku库存',
                              `sale_num` int(11) NOT NULL DEFAULT 0 COMMENT '销量',
                              `sku_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'sku主图',
                              `goods_state` tinyint(4) NOT NULL DEFAULT 1 COMMENT '商品状态（1.正常0下架）',
                              `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否已经删除',
                              `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                              `modify_time` int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
                              `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认',
                              PRIMARY KEY (`sku_id`) USING BTREE,
                              INDEX `IDX_ns_goods_is_delete`(`is_delete`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of goods_sku
-- ----------------------------
INSERT INTO `goods_sku` VALUES (1, 1, '红色', '', 50.00, 25, 0, '', 1, 0, 0, 0, 0);
INSERT INTO `goods_sku` VALUES (2, 1, '绿色', '', 50.00, 25, 0, '', 1, 0, 0, 0, 1);
INSERT INTO `goods_sku` VALUES (3, 1, '黄色', '', 60.00, 25, 0, '', 1, 0, 0, 0, 0);
INSERT INTO `goods_sku` VALUES (4, 1, '粉色', '', 50.00, 25, 0, '', 1, 0, 0, 0, 0);

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
                           `member_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
                           `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
                           PRIMARY KEY (`member_id`) USING BTREE,
                           INDEX `IDX_sys_user_user_name`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 201 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, '0号客户');
INSERT INTO `member` VALUES (101, '100号客户');
INSERT INTO `member` VALUES (102, '101号客户');
INSERT INTO `member` VALUES (103, '102号客户');
INSERT INTO `member` VALUES (104, '103号客户');
INSERT INTO `member` VALUES (105, '104号客户');
INSERT INTO `member` VALUES (106, '105号客户');
INSERT INTO `member` VALUES (107, '106号客户');
INSERT INTO `member` VALUES (108, '107号客户');
INSERT INTO `member` VALUES (109, '108号客户');
INSERT INTO `member` VALUES (110, '109号客户');
INSERT INTO `member` VALUES (11, '10号客户');
INSERT INTO `member` VALUES (111, '110号客户');
INSERT INTO `member` VALUES (112, '111号客户');
INSERT INTO `member` VALUES (113, '112号客户');
INSERT INTO `member` VALUES (114, '113号客户');
INSERT INTO `member` VALUES (115, '114号客户');
INSERT INTO `member` VALUES (116, '115号客户');
INSERT INTO `member` VALUES (117, '116号客户');
INSERT INTO `member` VALUES (118, '117号客户');
INSERT INTO `member` VALUES (119, '118号客户');
INSERT INTO `member` VALUES (120, '119号客户');
INSERT INTO `member` VALUES (12, '11号客户');
INSERT INTO `member` VALUES (121, '120号客户');
INSERT INTO `member` VALUES (122, '121号客户');
INSERT INTO `member` VALUES (123, '122号客户');
INSERT INTO `member` VALUES (124, '123号客户');
INSERT INTO `member` VALUES (125, '124号客户');
INSERT INTO `member` VALUES (126, '125号客户');
INSERT INTO `member` VALUES (127, '126号客户');
INSERT INTO `member` VALUES (128, '127号客户');
INSERT INTO `member` VALUES (129, '128号客户');
INSERT INTO `member` VALUES (130, '129号客户');
INSERT INTO `member` VALUES (13, '12号客户');
INSERT INTO `member` VALUES (131, '130号客户');
INSERT INTO `member` VALUES (132, '131号客户');
INSERT INTO `member` VALUES (133, '132号客户');
INSERT INTO `member` VALUES (134, '133号客户');
INSERT INTO `member` VALUES (135, '134号客户');
INSERT INTO `member` VALUES (136, '135号客户');
INSERT INTO `member` VALUES (137, '136号客户');
INSERT INTO `member` VALUES (138, '137号客户');
INSERT INTO `member` VALUES (139, '138号客户');
INSERT INTO `member` VALUES (140, '139号客户');
INSERT INTO `member` VALUES (14, '13号客户');
INSERT INTO `member` VALUES (141, '140号客户');
INSERT INTO `member` VALUES (142, '141号客户');
INSERT INTO `member` VALUES (143, '142号客户');
INSERT INTO `member` VALUES (144, '143号客户');
INSERT INTO `member` VALUES (145, '144号客户');
INSERT INTO `member` VALUES (146, '145号客户');
INSERT INTO `member` VALUES (147, '146号客户');
INSERT INTO `member` VALUES (148, '147号客户');
INSERT INTO `member` VALUES (149, '148号客户');
INSERT INTO `member` VALUES (150, '149号客户');
INSERT INTO `member` VALUES (15, '14号客户');
INSERT INTO `member` VALUES (151, '150号客户');
INSERT INTO `member` VALUES (152, '151号客户');
INSERT INTO `member` VALUES (153, '152号客户');
INSERT INTO `member` VALUES (154, '153号客户');
INSERT INTO `member` VALUES (155, '154号客户');
INSERT INTO `member` VALUES (156, '155号客户');
INSERT INTO `member` VALUES (157, '156号客户');
INSERT INTO `member` VALUES (158, '157号客户');
INSERT INTO `member` VALUES (159, '158号客户');
INSERT INTO `member` VALUES (160, '159号客户');
INSERT INTO `member` VALUES (16, '15号客户');
INSERT INTO `member` VALUES (161, '160号客户');
INSERT INTO `member` VALUES (162, '161号客户');
INSERT INTO `member` VALUES (163, '162号客户');
INSERT INTO `member` VALUES (164, '163号客户');
INSERT INTO `member` VALUES (165, '164号客户');
INSERT INTO `member` VALUES (166, '165号客户');
INSERT INTO `member` VALUES (167, '166号客户');
INSERT INTO `member` VALUES (168, '167号客户');
INSERT INTO `member` VALUES (169, '168号客户');
INSERT INTO `member` VALUES (170, '169号客户');
INSERT INTO `member` VALUES (17, '16号客户');
INSERT INTO `member` VALUES (171, '170号客户');
INSERT INTO `member` VALUES (172, '171号客户');
INSERT INTO `member` VALUES (173, '172号客户');
INSERT INTO `member` VALUES (174, '173号客户');
INSERT INTO `member` VALUES (175, '174号客户');
INSERT INTO `member` VALUES (176, '175号客户');
INSERT INTO `member` VALUES (177, '176号客户');
INSERT INTO `member` VALUES (178, '177号客户');
INSERT INTO `member` VALUES (179, '178号客户');
INSERT INTO `member` VALUES (180, '179号客户');
INSERT INTO `member` VALUES (18, '17号客户');
INSERT INTO `member` VALUES (181, '180号客户');
INSERT INTO `member` VALUES (182, '181号客户');
INSERT INTO `member` VALUES (183, '182号客户');
INSERT INTO `member` VALUES (184, '183号客户');
INSERT INTO `member` VALUES (185, '184号客户');
INSERT INTO `member` VALUES (186, '185号客户');
INSERT INTO `member` VALUES (187, '186号客户');
INSERT INTO `member` VALUES (188, '187号客户');
INSERT INTO `member` VALUES (189, '188号客户');
INSERT INTO `member` VALUES (190, '189号客户');
INSERT INTO `member` VALUES (19, '18号客户');
INSERT INTO `member` VALUES (191, '190号客户');
INSERT INTO `member` VALUES (192, '191号客户');
INSERT INTO `member` VALUES (193, '192号客户');
INSERT INTO `member` VALUES (194, '193号客户');
INSERT INTO `member` VALUES (195, '194号客户');
INSERT INTO `member` VALUES (196, '195号客户');
INSERT INTO `member` VALUES (197, '196号客户');
INSERT INTO `member` VALUES (198, '197号客户');
INSERT INTO `member` VALUES (199, '198号客户');
INSERT INTO `member` VALUES (200, '199号客户');
INSERT INTO `member` VALUES (20, '19号客户');
INSERT INTO `member` VALUES (2, '1号客户');
INSERT INTO `member` VALUES (21, '20号客户');
INSERT INTO `member` VALUES (22, '21号客户');
INSERT INTO `member` VALUES (23, '22号客户');
INSERT INTO `member` VALUES (24, '23号客户');
INSERT INTO `member` VALUES (25, '24号客户');
INSERT INTO `member` VALUES (26, '25号客户');
INSERT INTO `member` VALUES (27, '26号客户');
INSERT INTO `member` VALUES (28, '27号客户');
INSERT INTO `member` VALUES (29, '28号客户');
INSERT INTO `member` VALUES (30, '29号客户');
INSERT INTO `member` VALUES (3, '2号客户');
INSERT INTO `member` VALUES (31, '30号客户');
INSERT INTO `member` VALUES (32, '31号客户');
INSERT INTO `member` VALUES (33, '32号客户');
INSERT INTO `member` VALUES (34, '33号客户');
INSERT INTO `member` VALUES (35, '34号客户');
INSERT INTO `member` VALUES (36, '35号客户');
INSERT INTO `member` VALUES (37, '36号客户');
INSERT INTO `member` VALUES (38, '37号客户');
INSERT INTO `member` VALUES (39, '38号客户');
INSERT INTO `member` VALUES (40, '39号客户');
INSERT INTO `member` VALUES (4, '3号客户');
INSERT INTO `member` VALUES (41, '40号客户');
INSERT INTO `member` VALUES (42, '41号客户');
INSERT INTO `member` VALUES (43, '42号客户');
INSERT INTO `member` VALUES (44, '43号客户');
INSERT INTO `member` VALUES (45, '44号客户');
INSERT INTO `member` VALUES (46, '45号客户');
INSERT INTO `member` VALUES (47, '46号客户');
INSERT INTO `member` VALUES (48, '47号客户');
INSERT INTO `member` VALUES (49, '48号客户');
INSERT INTO `member` VALUES (50, '49号客户');
INSERT INTO `member` VALUES (5, '4号客户');
INSERT INTO `member` VALUES (51, '50号客户');
INSERT INTO `member` VALUES (52, '51号客户');
INSERT INTO `member` VALUES (53, '52号客户');
INSERT INTO `member` VALUES (54, '53号客户');
INSERT INTO `member` VALUES (55, '54号客户');
INSERT INTO `member` VALUES (56, '55号客户');
INSERT INTO `member` VALUES (57, '56号客户');
INSERT INTO `member` VALUES (58, '57号客户');
INSERT INTO `member` VALUES (59, '58号客户');
INSERT INTO `member` VALUES (60, '59号客户');
INSERT INTO `member` VALUES (6, '5号客户');
INSERT INTO `member` VALUES (61, '60号客户');
INSERT INTO `member` VALUES (62, '61号客户');
INSERT INTO `member` VALUES (63, '62号客户');
INSERT INTO `member` VALUES (64, '63号客户');
INSERT INTO `member` VALUES (65, '64号客户');
INSERT INTO `member` VALUES (66, '65号客户');
INSERT INTO `member` VALUES (67, '66号客户');
INSERT INTO `member` VALUES (68, '67号客户');
INSERT INTO `member` VALUES (69, '68号客户');
INSERT INTO `member` VALUES (70, '69号客户');
INSERT INTO `member` VALUES (7, '6号客户');
INSERT INTO `member` VALUES (71, '70号客户');
INSERT INTO `member` VALUES (72, '71号客户');
INSERT INTO `member` VALUES (73, '72号客户');
INSERT INTO `member` VALUES (74, '73号客户');
INSERT INTO `member` VALUES (75, '74号客户');
INSERT INTO `member` VALUES (76, '75号客户');
INSERT INTO `member` VALUES (77, '76号客户');
INSERT INTO `member` VALUES (78, '77号客户');
INSERT INTO `member` VALUES (79, '78号客户');
INSERT INTO `member` VALUES (80, '79号客户');
INSERT INTO `member` VALUES (8, '7号客户');
INSERT INTO `member` VALUES (81, '80号客户');
INSERT INTO `member` VALUES (82, '81号客户');
INSERT INTO `member` VALUES (83, '82号客户');
INSERT INTO `member` VALUES (84, '83号客户');
INSERT INTO `member` VALUES (85, '84号客户');
INSERT INTO `member` VALUES (86, '85号客户');
INSERT INTO `member` VALUES (87, '86号客户');
INSERT INTO `member` VALUES (88, '87号客户');
INSERT INTO `member` VALUES (89, '88号客户');
INSERT INTO `member` VALUES (90, '89号客户');
INSERT INTO `member` VALUES (9, '8号客户');
INSERT INTO `member` VALUES (91, '90号客户');
INSERT INTO `member` VALUES (92, '91号客户');
INSERT INTO `member` VALUES (93, '92号客户');
INSERT INTO `member` VALUES (94, '93号客户');
INSERT INTO `member` VALUES (95, '94号客户');
INSERT INTO `member` VALUES (96, '95号客户');
INSERT INTO `member` VALUES (97, '96号客户');
INSERT INTO `member` VALUES (98, '97号客户');
INSERT INTO `member` VALUES (99, '98号客户');
INSERT INTO `member` VALUES (100, '99号客户');
INSERT INTO `member` VALUES (10, '9号客户');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
                          `order_id` int(11) NOT NULL AUTO_INCREMENT,
                          `order_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '订单编号',
                          `order_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '订单内容',
                          `out_trade_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付流水号',
                          `order_status` int(11) NOT NULL DEFAULT 0 COMMENT '订单状态',
                          `pay_status` int(11) NOT NULL DEFAULT 0 COMMENT '支付状态',
                          `delivery_status` int(11) NOT NULL DEFAULT 0 COMMENT '配送状态',
                          `refund_status` int(11) NOT NULL DEFAULT 0 COMMENT '退款状态',
                          `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                          `pay_time` int(11) NOT NULL DEFAULT 0 COMMENT '订单支付时间',
                          `goods_num` int(11) NOT NULL DEFAULT 0 COMMENT '商品件数',
                          `member_id` int(11) NOT NULL DEFAULT 0 COMMENT '购买人uid',
                          `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
                          PRIMARY KEY (`order_id`) USING BTREE,
                          INDEX `IDX_ns_order_create_time`(`create_time`) USING BTREE,
                          INDEX `IDX_ns_order_member_id`(`member_id`) USING BTREE,
                          INDEX `IDX_ns_order_order_status`(`order_status`) USING BTREE,
                          INDEX `IDX_ns_order_pay_status`(`pay_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pay
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay`  (
                        `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
                        `out_trade_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付流水号',
                        `pay_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付方式',
                        `trade_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '交易单号',
                        `pay_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付账号',
                        `pay_body` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付主体',
                        `pay_detail` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付详情',
                        `pay_money` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '支付金额',
                        `pay_status` int(11) NOT NULL DEFAULT 0 COMMENT '支付状态（0.待支付 1. 支付中 2. 已支付 -1已取消）',
                        `return_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '同步回调网址',
                        `event` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支付成功后事件(事件，网址)',
                        `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                        `pay_time` int(11) NOT NULL DEFAULT 0 COMMENT '支付时间',
                        `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
                        PRIMARY KEY (`id`) USING BTREE,
                        UNIQUE INDEX `UK_ns_pay_out_trade_no`(`out_trade_no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '支付记录' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;