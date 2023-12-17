<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatAIController extends Controller
{
    public function index() {
     
       dd(session()->get('question')) ;
      ;
     
    }
    // public function index() {
    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' .env('CHAT_GPT_KEY') , 
    //     ])->post('https://api.openai.com/v1/chat/completions', [
    //         "model" => "gpt-3.5-turbo",
    //         "messages" => [
    //             [
    //                 "role" => "user",
    //                 "content" => "xin chào bạn, bạn là ai",
    //             ],
    //         ],
    //         'temperature' => 0.5,
    //             'max_tokens' => 200,
    //             'top_p' => 1.0,
    //             'frequency_penalty' => 0.52,
    //             'presence_penalty' => 0.5,
    //             'stop' => ["11."],
    //     ]);

    //     // You can then retrieve the response body as JSON or handle it accordingly
    //     $responseData = $response->json();
    //     return ($responseData['choices'][0]['message']['content']);;
    // }
    public function processQuesion(Request $request) {
        $traning_text = $this->traning_text($request->content);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' .env('CHAT_GPT_KEY') , 
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => $traning_text,
                ],
                [
                    "role" => "user",
                    "content" => $request->content,
                ],
            ],
            'temperature' => 0.5,
                'max_tokens' => 400,
                'top_p' => 1.0,
                'frequency_penalty' => 0.52,
                'presence_penalty' => 0.5,
                // 'stop' => ["11."],
        ]);

        // You can then retrieve the response body as JSON or handle it accordingly
        $responseData = $response->json();
    
        // session()->flush('question');
        // if(!session()->has('question')) {
        //     $data1 = [ $request->content];
        //     $data2 = [$responseData['choices'][0]['message']['content']];
        //     $full_question = [
        //         "client" => [$data1],
        //         "bot" => [$data2],
        //     ];
        //     session()->put('question',$full_question);
        // }else {
        //     $full_question =  session()->get('question');
        //     $full_question["client"][] =  $request->content;
        //     $full_question["bot"][] = $responseData['choices'][0]['message']['content'];
        //     session()->put('question',$full_question);
            
        // }
        return ($responseData['choices'][0]['message']['content']);;


    }
    public function traning_text($content) {
    //   Câu trả lời hỏi trước đó
        // if(session()->has('question')) {
        //     $full_question = session()->get('question');
        // }
        // else {
        //     $full_question = [
        //         "client" => ["hello"],
        //         "bot" => ["hello"],
        //     ];
        // }
        $cst = "";

        if (isset($full_question['client']) && isset($full_question['bot'])) {
            $clients = $full_question['client'];
            $bots = $full_question['bot'];
        
            // Duyệt qua các cặp câu hỏi và câu trả lời
            foreach ($clients as $index => $clientQuestion) {
                // Kiểm tra xem $clientQuestion là mảng hay không
                $clientQuestionText = is_array($clientQuestion) ? implode(', ', $clientQuestion) : $clientQuestion;
            
                // Kiểm tra xem $botAnswer là mảng hay không
                $botAnswerText = isset($bots[$index]) && is_array($bots[$index]) ? implode(', ', $bots[$index]) : $bots[$index];
            
                // Tạo đoạn lệnh "Khách đã hỏi.., Bot đã trả lời"
                $cst .= "Khách hỏi: \"$clientQuestionText\", Bạn đã trả lời: \"$botAnswerText\"\n";
            }
        } else {
            $cst = "Không có dữ liệu câu hỏi và trả lời.";
        }
     ;
      
// Hết
        $product_model = new ProductModel();
        $text ="Đối với";
        $products = $product_model->renderMenu();
      
        foreach($products as $product) {
            $text.=$product->tensanpham .
            ", id=".$product->id.
            ", mô tả của sản phẩm này:".$product->mota .
            ", thuộc danh mục:".$product->tendanhmuc.
            ", số lượng còn:".$product->soluong.
            ", giá sản phẩm:".$product->gia.
            ", ngày được thêm:".$product->ngaythem.
            ", hình ảnh:".$product->hinhanh.
            ";\nĐối với ";
        }
        
        // dd($text);
        // '$cst' 
        // bạn phải dựa vào đoạn hội thoại trước đây của chúng ta với khách(ở trên), nếu khách có hỏi câu liên quan đến câu hỏi trước đó thì phải dựa vào câu hỏi gần nhất, sát nhất trước đó để trả lời
        $traning_text = "
        Bạn là một trợ lý cho một website pizza,đây là toàn bộ danh sách sản phẩm của cửa hàng chúng ta:$text \n
        
        Khi trả lời cho khách hàng cần thực hiện các điều dưới đây:
        1) Trả lời ngắn gọn
       
        2) Nếu khách hàng có hỏi cách mua hoặc link sản phẩm, gợi ý link để đi đến sản phẩm theo cấu trúc link như sau
        <a href='http://127.0.0.1:8000/detail_product/id'><b>Tên Sản Phẩm</b></a>,
        nhớ để link trong cặp thẻ a, với id cuối cùng trong url trên, ta sẽ lấy từ id của các sản phẩm đã nêu trong danh sách
        3) Và chúng ta có một số sản phẩm sau đây,chú ý tên sản phẩm, vì tên sản phẩm phải giống tuyệt đối, Ví dụ:pizza thịt heo khác với pizza thịt xông khói, phải để ý tên, nếu khách hàng có hỏi cần phải trả lời
        4) Trong các mô tả sản phẩm trên sẽ có có thẻ html được định dạng và có các nội dung ở trong, hãy tự loại bỏ các tag html đó, chỉ tập trung trả lời chính xác vào nội dung được miêu tả ở trong đó VÀ PHÙ HỢP VỚI YÊU CẦU KHÁCH HÀNG
        5) Nếu như khách hàng có yêu cầu xem ảnh, thì thêm một đoạn html như sau:
        <div class='img_bot'><img class='img_chat' src='' ></div>
        Với src sẽ bằng link hình ảnh của sản phẩm đã nói ở trên, và luôn trả thẻ img này về cuối câu trả lời của mình khi trả lời cho khách hàng
        6) Khi trả về câu trả lời có xuống dòng, phải chuyển /n có chức năng xuống dòng đây thành thẻ <br> để xuống dòng, vì nó dịch sang html
        7) thông tin của cửa hàng là : số điện thoại cửa hàng : 0987678573, tên chủ cửa hàng: Hưng, Địa chỉ:
         <a href='https://bom.so/iJufQK'><b>Trường Việt Hàn<b>(click vào để xem địa chỉ)</a>, 
        ";

        return    $traning_text;
    }
}
