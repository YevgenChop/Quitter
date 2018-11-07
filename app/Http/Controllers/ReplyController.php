<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Services\ApiAuthService;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use App\Models\Reply;

class ReplyController extends Controller
{
    /**
     * Get a Json listing of the replies.
     *
     * @param Request $request
     * @param $message_id
     * @param MessageService $messageService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $message_id, MessageService $messageService): JsonResponse
    {
        return Response::json($messageService->listReplies(
            $message_id,
            $request->input('page', 0),
            $request->input('perPage', 10)
        ), 200, ['X-total-count' => $messageService->countReplies($message_id)]);
    }

    /**
     * Store new Reply.
     *
     * @param $message_id
     * @param ReplyRequest $request
     * @param MessageService $messageService
     * @param ApiAuthService $authService
     * @return void
     */
    public function store($message_id, ReplyRequest $request, MessageService $messageService)
    {
        $messageService->reply(\Auth::id(), $message_id, $request->validated());
    }

    /**
     * Display the specified Reply.
     *
     * @param $message_id
     * @param  int $id
     * @param MessageService $messageService
     * @return JsonResponse
     */
    public function show($id, MessageService $messageService)
    {
        return Response::json($messageService->getReply($id));
    }

    /**
     * Update the specified Reply.
     *
     * @param  int $id
     * @param ReplyRequest $request
     * @param MessageService $messageService
     * @param ApiAuthService $authService
     * @return void
     */
    public function update(int $id, ReplyRequest $request, MessageService $messageService)
    {
        $this->authorize('update', Reply::find($id));

        $messageService->updateReply($id, $request->validated());
    }

    /**
     * Remove the specified Reply.
     *
     * @param  int $id
     * @param MessageService $messageService
     * @param ApiAuthService $authService
     * @return void
     */
    public function destroy(int $id, MessageService $messageService)
    {
        $this->authorize('destroy', Reply::find($id));

        $messageService->deleteReply($id);
    }
}
