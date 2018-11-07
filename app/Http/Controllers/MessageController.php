<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Services\ApiAuthService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Response;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Get a Json listing of the messages.
     *
     * @param Request $request
     * @param MessageService $messageService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, MessageService $messageService)
    {
        return Response::json(
            $messageService->listMessages(
                $request->input('page', 0),
                $request->input('perPage', 10)
            ), 200, ['X-total-count' => $messageService->countMessages()]
        );
    }

    /**
     * Store new Message.
     *
     * @param MessageRequest $request
     * @param MessageService $messageService
     * @param ApiAuthService $authService
     * @return void
     */
    public function store(MessageRequest $request, MessageService $messageService)
    {
        $messageService->message(\Auth::id(), $request->validated());
    }

    /**
     * Display the specified Message.
     *
     * @param  int $id
     * @param MessageService $messageService
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, MessageService $messageService)
    {
        return Response::json($messageService->getMessage($id));
    }

    /**
     * Update the specified Message.
     *
     * @param  int $id
     * @param MessageRequest $request
     * @param MessageService $messageService
     * @param ApiAuthService $authService
     * @return void
     */
    public function update(int $id, MessageRequest $request, MessageService $messageService)
    {
        $this->authorize('update', Message::find($id));

        $messageService->updateMessage($id, $request->validated());
    }

    /**
     * Remove the specified Message.
     *
     * @param  int $id
     * @param MessageService $messageService
     * @param ApiAuthService $authService
     * @return void
     */
    public function destroy(int $id, MessageService $messageService)
    {
        $this->authorize('destroy', Message::find($id));

        $messageService->deleteMessage($id);
    }
}
