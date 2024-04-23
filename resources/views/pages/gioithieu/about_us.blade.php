@extends('welcome')
@section('content')

    <!-- Detail Start -->
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-3">
{{--                     <p class="section-title pr-5"><span class="pr-2">Giới thiệu</span></p>
 --}}                    <h1 class="mb-3">Về chúng tôi</h1>
                </div>
                <div class="mb-5" style="width: 1140px ">
                    <p>Được thành lập từ năm 2022, đến nay sau hơn 1 năm phát triển, Trung tâm Tiếng Anh LieLie đã được công nhận là một trong những thương hiệu hàng đầu về học tiếng Anh chất lượng trên địa bàn. Hiện nay, chúng tôi chuyên cung cấp các khóa đào tạo tiếng Anh dành cho mọi đối tượng từ thiếu nhi đến người lớn. Các chương trình đào tạo bao gồm: Các khóa tiếng Anh cho dành cho thiếu nhi 3 - 6, thiếu niên, luyện thi IELTS: Tiếng Anh học thuật, luyện thi các chứng chỉ quốc tế: IELTS, TOEIC,FCE… cam kết đầu ra, tiếng Anh giao tiếp, tiếng Anh giao tiếp theo phương pháp chủ động, Tiếng Anh liên kết trường học.</p><br>
                    <p>Với phương pháp Active Learning độc đáo và đội ngũ giáo viên bản ngữ từ Anh, Mỹ, Canada, Australia nhiều kinh nghiệm, đã đóng góp vào sự phát triển của nền giáo dục Việt Nam nói chung và nâng cao khả năng sử dụng tiếng Anh cho những ai yêu thích học và sử dụng tiếng Anh nói riêng và đặc biệt là học sinh, sinh viên, người đi làm tại Nghệ An.</p>
                    <h3 class="mb-4">Tầm nhìn - Sứ mệnh - Giá trị cốt lõi</h3>
                    <h4>Tầm nhìn</h4>
                    <p>Với khát vọng tiên phong cùng với chiến lược phát triển bền vững, Trung tâm Tiếng Anh LieLie xác định tầm nhìn trở thành hệ thống các trung tâm Anh ngữ tiêu chuẩn hàng đầu tại Nghệ An nói riêng và Việt Nam nói chung, đạt chuẩn quốc tế về giáo dục và đào tạo.</p>
                    <h4>Sứ mệnh</h4>
                    Chúng tôi luôn đồng hành cùng học viên, chú trọng vào chất lượng giảng dạy nhằm giúp học viên đạt được các mục tiêu sau:
                    <ul>
                        <li>Phát triển những kỹ năng cuộc sống để đạt thành tích cao trong học tập và vững bước tương lai.</li>
                        <li>Học để Biết: biết về văn hóa, xã hội, con người và từ đó hoàn thiện bản thân, nâng cao vị thế bản thân;</li>
                        <li>Học để Làm: “Học đi đôi với hành” hay trong ngữ cảnh của chúng ta thì học Tiếng Anh là phải sử dụng được trong cuộc sống, giao tiếp và công việc. Học tốt tiếng Anh cần mang lại cho chúng ta các kết quả đo đếm được như học bổng du học, công việc hấp dẫn và thu nhập cao hơn, mở ra cho chúng ta các cơ hội thành công mới.</li>
                        <li>Học để Chung sống: trong “Thế giới phẳng” hiện nay cả xã hội loài người ở các quốc gia khác nhau đang tham gia vào từng quá trình của chuỗi liên kết toàn cầu. Học để chung sống là một kỹ năng thiết yếu đối với mỗi cá nhân.</li>
                        <li>Học để Tự lập: cách tư duy để vượt qua khó khăn trong cuộc sống chính là bí quyết thành công của người Mỹ. Học tiếng Anh và tư duy logic sẽ giúp chúng ta tự lập, tự tin và thành công.</li>
                    </ul>
                    <p style="text-align: center; text"><b>“Thành công của học viên cũng chính là thành công của chúng tôi.”</b></p>
                    <h4>Giá trị cốt lõi</h4>
                    <ul>
                        <li>Chất lượng sư phạm và dịch vụ hàng đầu tại Vinh – Nghệ An.</li>
                        <li>Luôn phấn đấu để mang lại những giá trị đích thực, tiết giảm chi phí học tập, mang lại cơ hội học tiếng Anh chất lượng quốc tế với giá cả phù hợp với đông đảo mọi người.</li>
                    </ul>
                    <h3 class="mb-4">Cơ sở vật chất</h3>
                    <img class="img-fluid rounded w-45 float-left mr-4 mb-3" style="width: 500px; height: 300px;" src="public/frontend/image/ban.jpg" alt="Image">
                    <p>Tại địa chỉ xã Quỳnh Diễn, trung tâm có khuôn viên rộng rãi, thoáng mát, nơi gửi xe thuận tiện cho học viên, an ninh – bảo vệ tốt nên phụ huynh của những học viên Kids-Teens có thể hoàn toàn yên tâm cho con đi học.

                    Phương pháp Active Learning được đưa vào trong môi trường có cơ sở vật chất hiện đại, trẻ trung và luôn mang lại không khí học tập hứng khởi cho học viên. Hệ thống bảng tương tác, màn hình LED, hệ thống cơ sở vật chất hiện đại, phần mềm học tiếng Anh (dạy các môn khoa học và toán bằng tiếng Anh), thư viện sách phong phú sẽ tạo điều kiện học tập tốt nhất cho học viên. Môi trường học tập theo chuẩn quốc tế, tạo sự thân thiện giữa giáo viên và học viên nhằm khuyến khích học viên giao tiếp nhiều hơn, thỏa sức sáng tạo để buổi học trở nên sinh động và hiệu quả.</p><br><br><br>
                    <h3 class="mb-4">Đội ngũ giáo viên</h3>
                    <img class="img-fluid rounded w-45 float-right ml-4 mb-3" style="width: 400px; height: 200px" src="public/frontend/image/ac.jpg" alt="Image">
                    <p>Tất cả các giáo viên bản ngữ của Trung tâm Tiếng Anh LieLie đều đến từ các nước Anh, Mỹ, Canada và Australia… có bằng đại học, có chứng chỉ dạy Anh ngữ chuyên nghiệp và có nhiều kinh nghiệm trong việc giảng dạy Anh ngữ cho người nước ngoài. Để phục vụ thuận tiện cho việc giảng dạy của giáo viên bản ngữ; trao đổi tình hình, kết quả học tập với phụ huynh học viên, trung tâm còn có một đội ngũ trợ giảng là các giảng viên, sinh viên, học viên đã có nghiệp vụ sư phạm và các chứng chỉ quốc tế IELTS, TOEIC với điểm số cao nhằm hỗ trợ tốt nhất việc học tập của học viên.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- Detail End -->

@endsection