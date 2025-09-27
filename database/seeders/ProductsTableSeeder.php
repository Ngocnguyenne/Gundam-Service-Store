<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            //======================================================================
            // DANH MỤC DỊCH VỤ (id_category = 1)
            //======================================================================
            [
                'id' => 1, 'name' => 'Dịch Vụ Sơn Màu Tùy Chỉnh (MG)', 'image_path' => 'images/products/1.jfif', 'price' => 2500000,
                'description' => 'Biến mô hình Master Grade của bạn thành một tác phẩm độc nhất. Chúng tôi sẽ sơn lại toàn bộ kit theo bảng màu yêu cầu, sử dụng sơn cao cấp và kỹ thuật che chắn chuyên nghiệp để tạo ra bề mặt hoàn hảo.',
                'id_category' => 1, 'discount' => 10, 'amount' => 999,
            ],
            [
                'id' => 2, 'name' => 'Dịch Vụ Lắp Ráp Hoàn Thiện (HG/RG)', 'image_path' => 'images/products/2.jpg', 'price' => 500000,
                'description' => 'Không có thời gian lắp ráp? Hãy để chúng tôi giúp bạn. Dịch vụ bao gồm lắp ráp, xử lý sẹo nhựa, kẻ lằn chìm và dán decal cho các kit HG/RG. Bạn sẽ nhận ngay sản phẩm hoàn chỉnh để trưng bày.',
                'id_category' => 1, 'discount' => 20, 'amount' => 999,
            ],
            [
                'id' => 3, 'name' => 'Dịch Vụ Dán Decal Nước Chuyên Nghiệp (Mọi tỷ lệ)', 'image_path' => 'images/products/3.jfif', 'price' => 350000,
                'description' => 'Decal nước giúp mô hình chi tiết và chân thực hơn gấp bội. Chúng tôi nhận dán decal nước cho mọi loại kit, sử dụng dung dịch làm mềm decal (setter/softer) để decal bám chắc và phẳng mịn trên bề mặt cong.',
                'id_category' => 1, 'discount' => 0, 'amount' => 999,
            ],
            [
                'id' => 4, 'name' => 'Dịch Vụ Lắp & Sơn Cao Cấp (PG/MGEX)', 'image_path' => 'images/products/4.png', 'price' => 8000000,
                'description' => 'Gói dịch vụ cao cấp nhất dành cho các kit PG và MGEX. Bao gồm lắp ráp, xử lý bề mặt, sơn pre-shading, đi dây LED (nếu có), dán decal và phủ lớp bảo vệ. Cam kết mang lại một kiệt tác trưng bày.',
                'id_category' => 1, 'discount' => 5, 'amount' => 999,
            ],

            //======================================================================
            // DANH MỤC DỤNG CỤ & PHỤ KIỆN (id_category = 2)
            //======================================================================
            [
                'id' => 5, 'name' => 'Bộ Kìm Cắt GodHand GH-SPN-120', 'image_path' => 'images/products/5.png', 'price' => 950000,
                'description' => 'Kìm cắt "thần thánh" từ GodHand, cho vết cắt siêu mịn như dao mổ, giảm thiểu tối đa sẹo nhựa và thời gian xử lý. Công cụ tối thượng cho mọi builder chuyên nghiệp.',
                'id_category' => 2, 'discount' => 10, 'amount' => 40,
            ],
            [
                'id' => 6, 'name' => 'Bộ Bút Kẻ Lằn Chìm Tamiya Panel Line', 'image_path' => 'images/products/6.png', 'price' => 180000,
                'description' => 'Bút kẻ chuyên dụng của Tamiya với đầu cọ siêu mảnh, giúp làm nổi bật các đường nét chi tiết, tăng chiều sâu và độ chân thực cho mô hình một cách dễ dàng.',
                'id_category' => 2, 'discount' => 0, 'amount' => 100,
            ],
            [
                'id' => 7, 'name' => 'Bộ Dũa Thủy Tinh Nano', 'image_path' => 'images/products/7.jpg', 'price' => 250000,
                'description' => 'Công cụ mài và đánh bóng thế hệ mới. Dũa thủy tinh nano giúp loại bỏ sẹo nhựa và làm bóng bề mặt chỉ trong một bước, không cần dùng nhiều loại giấy nhám khác nhau.',
                'id_category' => 2, 'discount' => 5, 'amount' => 75,
            ],
            [
                'id' => 8, 'name' => 'Action Base 5 (Clear)', 'image_path' => 'images/products/8.png', 'price' => 150000,
                'description' => 'Đế trưng bày chính hãng Bandai, phù hợp cho hầu hết các kit tỷ lệ 1/144. Giúp bạn tạo ra những tư thế hành động ấn tượng và tiết kiệm không gian trưng bày.',
                'id_category' => 2, 'discount' => 0, 'amount' => 200,
            ],
            [
                'id' => 9, 'name' => 'Tamiya Extra Thin Cement', 'image_path' => 'images/products/9.jpg', 'price' => 120000,
                'description' => 'Keo dán chuyên dụng cho mô hình nhựa, có độ loãng cao và khả năng tự chảy vào khe hẹp. Lý tưởng để hàn các chi tiết và xử lý đường nối (seam line).',
                'id_category' => 2, 'discount' => 0, 'amount' => 150,
            ],
            [
                'id' => 10, 'name' => 'Bộ Gundam Marker EX Metallic', 'image_path' => 'images/products/10.jpg', 'price' => 350000,
                'description' => 'Set bút sơn Gundam Marker cao cấp với các màu kim loại sáng bóng và đẹp mắt, giúp bạn tô điểm các chi tiết nhỏ như khớp, động cơ một cách nhanh chóng.',
                'id_category' => 2, 'discount' => 5, 'amount' => 80,
            ],
            [
                'id' => 11, 'name' => 'Mr. Hobby Mark Setter & Softer', 'image_path' => 'images/products/11.jpg', 'price' => 190000,
                'description' => 'Bộ đôi dung dịch không thể thiếu khi dán decal nước. Mark Setter tăng độ bám dính, Mark Softer làm mềm decal để ôm sát vào các bề mặt cong và gồ ghề.',
                'id_category' => 2, 'discount' => 0, 'amount' => 90,
            ],
            [
                'id' => 12, 'name' => 'Dao Trổ Tamiya Design Knife', 'image_path' => 'images/products/12.jpg', 'price' => 220000,
                'description' => 'Dao trổ chuyên dụng với lưỡi dao sắc bén, lý tưởng cho việc cắt decal, che sơn, và gọt các chi tiết nhựa thừa một cách chính xác.',
                'id_category' => 2, 'discount' => 10, 'amount' => 120,
            ],
            [
                'id' => 13, 'name' => 'Decal Nước DelpiDecal (RG Sazabi)', 'image_path' => 'images/products/13.png', 'price' => 200000,
                'description' => 'Bộ decal nước chất lượng cao từ DelpiDecal dành riêng cho kit RG Sazabi, với các họa tiết sắc nét và chi tiết hơn nhiều so với decal gốc đi kèm.',
                'id_category' => 2, 'discount' => 0, 'amount' => 60,
            ],
            [
                'id' => 14, 'name' => 'Bộ Đèn LED Bandai (Vàng)', 'image_path' => 'images/products/14.png', 'price' => 250000,
                'description' => 'Bộ đèn LED chính hãng Bandai màu vàng, dùng để lắp vào các kit MG/PG có hỗ trợ, giúp phần mắt hoặc các chi tiết khác phát sáng ấn tượng.',
                'id_category' => 2, 'discount' => 0, 'amount' => 50,
            ],

            //======================================================================
            // DANH MỤC MÔ HÌNH LẮP RÁP (Gunpla) (id_category = 3)
            //======================================================================
            [
                'id' => 15, 'name' => 'PG Unleashed 1/60 RX-78-2 Gundam', 'image_path' => 'images/products/15.jpg', 'price' => 5500000,
                'description' => 'Phiên bản Perfect Grade đột phá, mô phỏng quá trình lắp ráp một Mobile Suit thực thụ qua từng giai đoạn. Tích hợp đèn LED, khung xương phức tạp và hiệu ứng kim loại.',
                'id_category' => 3, 'discount' => 5, 'amount' => 8,
            ],
            [
                'id' => 16, 'name' => 'PG 1/60 Unicorn Gundam 01', 'image_path' => 'images/products/16.jpg', 'price' => 4800000,
                'description' => 'Mô hình Perfect Grade Unicorn với khả năng biến hình hoàn hảo từ chế độ Unicorn sang Destroy. Tương thích với bộ đèn LED bán rời để tái hiện Psycho-Frame rực rỡ.',
                'id_category' => 3, 'discount' => 10, 'amount' => 12,
            ],
            [
                'id' => 17, 'name' => 'MGEX 1/100 Strike Freedom Gundam', 'image_path' => 'images/products/17.jpg', 'price' => 3500000,
                'description' => 'Đỉnh cao của dòng Master Grade Extreme, tái hiện khung xương vàng phức tạp qua 3 lớp mạ và chi tiết kim loại sắc sảo. Một kiệt tác kỹ thuật không thể bỏ lỡ.',
                'id_category' => 3, 'discount' => 10, 'amount' => 15,
            ],
            [
                'id' => 18, 'name' => 'MGEX 1/100 Unicorn Gundam Ver. Ka', 'image_path' => 'images/products/18.jpg', 'price' => 5800000,
                'description' => 'Tái hiện Psycho-Frame một cách chưa từng có với dải LED linh hoạt, cho phép đổi màu và phát sáng đồng bộ. Một trải nghiệm lắp ráp và công nghệ đỉnh cao.',
                'id_category' => 3, 'discount' => 5, 'amount' => 7,
            ],
            [
                'id' => 19, 'name' => 'MG 1/100 Sazabi Ver. Ka', 'image_path' => 'images/products/19.jpg', 'price' => 2400000,
                'description' => 'Siêu phẩm được thiết kế bởi Hajime Katoki, với kích thước đồ sộ, chi tiết cơ khí sắc nét và cơ chế mở giáp để lộ khung xương bên trong.',
                'id_category' => 3, 'discount' => 15, 'amount' => 20,
            ],
            [
                'id' => 20, 'name' => 'MG 1/100 Barbatos Gundam', 'image_path' => 'images/products/20.jpg', 'price' => 1150000,
                'description' => 'Master Grade Barbatos nổi bật với bộ khung xương Gundam Frame chi tiết và các cơ chế piston thủy lực hoạt động song song với chuyển động của giáp.',
                'id_category' => 3, 'discount' => 10, 'amount' => 20,
            ],
            [
                'id' => 21, 'name' => 'MG 1/100 Wing Gundam Zero EW Ver.Ka', 'image_path' => 'images/products/21.jpg', 'price' => 1450000,
                'description' => 'Phiên bản Wing Zero với đôi cánh thiên thần trứ danh, được thiết kế lại dưới sự giám sát của Katoki. Tích hợp cơ chế biến hình thành Neo-Bird Mode.',
                'id_category' => 3, 'discount' => 5, 'amount' => 22,
            ],
            [
                'id' => 22, 'name' => 'MG 1/100 Freedom Gundam 2.0', 'image_path' => 'images/products/22.jpg', 'price' => 1200000,
                'description' => 'Phiên bản 2.0 của Freedom Gundam với tỷ lệ cơ thể được cải tiến, khung xương linh hoạt hơn và các chi tiết sắc sảo hơn, cho phép tạo lại tư thế HiMAT Full Burst ấn tượng.',
                'id_category' => 3, 'discount' => 10, 'amount' => 30,
            ],
            [
                'id' => 23, 'name' => 'RG 1/144 Hi-Nu Gundam', 'image_path' => 'images/products/23.jpg', 'price' => 980000,
                'description' => 'Một trong những bộ kit Real Grade được đánh giá cao nhất. Tái hiện Hi-Nu Gundam với độ chi tiết và cơ chế phức tạp đáng kinh ngạc ở tỷ lệ 1/144.',
                'id_category' => 3, 'discount' => 0, 'amount' => 25,
            ],
            [
                'id' => 24, 'name' => 'RG 1/144 God Gundam', 'image_path' => 'images/products/24.jpg', 'price' => 850000,
                'description' => 'Kit RG với biên độ cử động võ thuật đỉnh cao, mô phỏng cơ bắp của con người. Tái hiện lại những đòn thế mạnh mẽ của Burning Gundam một cách hoàn hảo.',
                'id_category' => 3, 'discount' => 10, 'amount' => 40,
            ],
            [
                'id' => 25, 'name' => 'RG 1/144 Sazabi', 'image_path' => 'images/products/25.jpg', 'price' => 1100000,
                'description' => 'Mang toàn bộ sự hoành tráng của Sazabi xuống tỷ lệ 1/144. Kit có kích thước lớn hơn hẳn các RG thông thường, đi kèm độ chi tiết và cơ chế mở giáp ấn tượng.',
                'id_category' => 3, 'discount' => 5, 'amount' => 35,
            ],
            [
                'id' => 26, 'name' => 'RG 1/144 Nu Gundam', 'image_path' => 'images/products/26.jpg', 'price' => 950000,
                'description' => 'Đối thủ truyền kiếp của Sazabi, Nu Gundam phiên bản RG cũng là một kit không thể bỏ qua với thiết kế hoàn hảo và bộ vũ khí Fin Funnel trứ danh.',
                'id_category' => 3, 'discount' => 0, 'amount' => 45,
            ],
            [
                'id' => 27, 'name' => 'HG 1/144 Aerial Rebuild Gundam', 'image_path' => 'images/products/27.jpg', 'price' => 450000,
                'description' => 'Mô hình High Grade từ series "The Witch from Mercury" với thiết kế mới mẻ và biên độ cử động cực kỳ linh hoạt, cho phép tạo lại những cảnh chiến đấu ấn tượng.',
                'id_category' => 3, 'discount' => 0, 'amount' => 30,
            ],
            [
                'id' => 28, 'name' => 'HG 1/144 Nightingale', 'image_path' => 'images/products/28.jpg', 'price' => 1800000,
                'description' => 'Mobile Armor khổng lồ của Char Aznable được tái hiện dưới dạng High Grade. Kit có kích thước choáng ngợp, to hơn cả nhiều kit MG thông thường.',
                'id_category' => 3, 'discount' => 10, 'amount' => 18,
            ],
            [
                'id' => 29, 'name' => 'HG 1/144 Xi Gundam', 'image_path' => 'images/products/29.jpg', 'price' => 1550000,
                'description' => 'Mô hình nhân vật chính từ phim "Hathaway\'s Flash", Xi Gundam có thiết kế độc đáo và kích thước lớn, đi kèm khả năng biến hình thành dạng bay.',
                'id_category' => 3, 'discount' => 5, 'amount' => 20,
            ],
            [
                'id' => 30, 'name' => 'HG 1/144 Michaelis', 'image_path' => 'images/products/30.jpg', 'price' => 420000,
                'description' => 'Mobile Suit của Shaddiq Zenelli từ "The Witch from Mercury", nổi bật với vũ khí Beam Bracer và thiết kế đậm chất hiệp sĩ.',
                'id_category' => 3, 'discount' => 0, 'amount' => 50,
            ],
            [
                'id' => 31, 'name' => 'EG 1/144 Nu Gundam', 'image_path' => 'images/products/31.jpg', 'price' => 280000,
                'description' => 'Dòng Entry Grade với chất lượng đáng kinh ngạc. Tách màu hoàn hảo, lắp ráp không cần kìm, nhưng vẫn giữ được vẻ đẹp và chi tiết của Nu Gundam.',
                'id_category' => 3, 'discount' => 0, 'amount' => 80,
            ],
            [
                'id' => 32, 'name' => 'EG 1/144 Strike Gundam', 'image_path' => 'images/products/32.jpg', 'price' => 200000,
                'description' => 'Lựa chọn hoàn hảo cho người mới bắt đầu. Dễ lắp, giá thành rẻ nhưng biên độ cử động và chi tiết không thua kém các kit HG đời mới.',
                'id_category' => 3, 'discount' => 0, 'amount' => 100,
            ],
            [
                'id' => 33, 'name' => 'Full Mechanics 1/100 Aerial Gundam', 'image_path' => 'images/products/33.jpg', 'price' => 950000,
                'description' => 'Dòng kit 1/100 với độ chi tiết cao hơn HG nhưng lắp ráp đơn giản hơn MG. Tái hiện Aerial Gundam ở kích thước lớn với nhiều chi tiết bề mặt sắc sảo.',
                'id_category' => 3, 'discount' => 10, 'amount' => 33,
            ],
            [
                'id' => 34, 'name' => 'SDCS Freedom Gundam', 'image_path' => 'images/products/34.jpg', 'price' => 300000,
                'description' => 'Dòng SD Cross Silhouette cho phép tùy chọn lắp giữa khung xương SD nhỏ nhắn hoặc khung CS cao ráo, cơ động hơn.',
                'id_category' => 3, 'discount' => 0, 'amount' => 65,
            ],

            //======================================================================
            // DANH MỤC FIGURE & HÀNG SƯU TẦM (id_category = 4)
            //======================================================================
            [
                'id' => 35, 'name' => 'Robot Spirits <SIDE MS> XVX-016 Gundam Aerial ver. A.N.I.M.E.', 'image_path' => 'images/products/35.jpg', 'price' => 1850000,
                'description' => 'Mô hình action figure hoàn chỉnh, sơn sẵn với độ chi tiết cao và biên độ cử động tuyệt vời từ dòng Robot Spirits. Đi kèm đầy đủ vũ khí và hiệu ứng.',
                'id_category' => 4, 'discount' => 15, 'amount' => 25,
            ],
            [
                'id' => 36, 'name' => 'Metal Build - Gundam Astray Red Dragonics', 'image_path' => 'images/products/36.jpg', 'price' => 7200000,
                'description' => 'Siêu phẩm từ dòng Metal Build với khung xương kim loại chắc chắn, chi tiết sắc bén và bộ trang bị "Caletvwlch" hoành tráng có thể biến đổi thành nhiều dạng.',
                'id_category' => 4, 'discount' => 5, 'amount' => 10,
            ],
            [
                'id' => 37, 'name' => 'S.H.Figuarts - Suletta Mercury', 'image_path' => 'images/products/37.jpg', 'price' => 1500000,
                'description' => 'Mô hình nhân vật Suletta Mercury từ "The Witch from Mercury" thuộc dòng S.H.Figuarts. Tái hiện sống động nhân vật với nhiều khớp cử động và biểu cảm khuôn mặt thay thế.',
                'id_category' => 4, 'discount' => 0, 'amount' => 35,
            ],
            [
                'id' => 38, 'name' => 'Metal Build - Hi-Nu Gundam', 'image_path' => 'images/products/38.jpg', 'price' => 8500000,
                'description' => 'Hi-Nu Gundam được tái hiện dưới dạng Metal Build với thiết kế được tùy chỉnh lại, mang vẻ ngoài hầm hố và chi tiết hơn. Một trong những figure được săn lùng nhất.',
                'id_category' => 4, 'discount' => 5, 'amount' => 9,
            ],
            [
                'id' => 39, 'name' => 'Metal Robot Spirits - Zeta Gundam', 'image_path' => 'images/products/39.jpg', 'price' => 3800000,
                'description' => 'Dòng Metal Robot Spirits kết hợp sự linh hoạt của Robot Spirits và các chi tiết khớp kim loại chắc chắn. Zeta Gundam có thể biến hình thành dạng Wave Rider.',
                'id_category' => 4, 'discount' => 10, 'amount' => 17,
            ],
            [
                'id' => 40, 'name' => 'S.H.Figuarts - Miorine Rembran', 'image_path' => 'images/products/40.jpg', 'price' => 1450000,
                'description' => 'Mô hình nhân vật Miorine Rembran, đối tác của Suletta. Figure có độ chi tiết cao ở trang phục và các phụ kiện đi kèm như bình tưới cây.',
                'id_category' => 4, 'discount' => 0, 'amount' => 40,
            ],
            [
                'id' => 41, 'name' => 'Hi-Resolution Model (HiRM) 1/100 God Gundam', 'image_path' => 'images/products/41.jpg', 'price' => 3300000,
                'description' => 'Dòng HiRM kết hợp giữa mô hình lắp ráp (phần giáp) và khung xương kim loại lắp sẵn. God Gundam có ngoại hình cơ bắp, mạnh mẽ và biên độ cử động cực cao.',
                'id_category' => 4, 'discount' => 15, 'amount' => 14,
            ],
            [
                'id' => 42, 'name' => 'Gundam Universe - RX-78-2 Gundam', 'image_path' => 'images/products/42.jpg', 'price' => 750000,
                'description' => 'Dòng figure giá rẻ của Bandai với kích thước 6-inch, thiết kế cứng cáp, phù hợp để chơi hoặc trưng bày mà không quá lo lắng về các chi tiết mỏng manh.',
                'id_category' => 4, 'discount' => 0, 'amount' => 55,
            ],
            [
                'id' => 43, 'name' => 'MegaHouse G.G.G - Char Aznable', 'image_path' => 'images/products/43.jpg', 'price' => 3200000,
                'description' => 'Tượng tĩnh (scale figure) cao cấp của nhân vật Char Aznable từ series Gundam Generation Gallery. Tái hiện thần thái và trang phục của "Sao Chổi Đỏ" một cách hoàn hảo.',
                'id_category' => 4, 'discount' => 5, 'amount' => 11,
            ],
            [
                'id' => 44, 'name' => 'FW Gundam Converge (Hộp 10 cái ngẫu nhiên)', 'image_path' => 'images/products/44.jpg', 'price' => 1400000,
                'description' => 'Dòng kẹo đồ chơi (shokugan) với các mẫu Gundam được thiết kế lại theo phong cách chibi nhưng vẫn giữ độ chi tiết cao. Bán dưới dạng hộp 10 pack ngẫu nhiên.',
                'id_category' => 4, 'discount' => 0, 'amount' => 30,
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(['id' => $productData['id']], $productData);
        }
    }
}