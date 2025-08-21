<?php

namespace App\Repositories\Approval;

interface ApprovalRepositoryInterface
{
    /**
     * Return list Approvals by notifier_type and requester_type.
     * 
     *
     * @param string approval_type_id
     * @param string requester_type
     * @return @var \Illuminate\Support\Collection<int, \stdClass|null> $approvals
     */
    public function getByNotifierTypeAndRequesterType($approval_type_id, $requester_type);
    /**
     * Creates a approval.
     * 
     *
     * @param string requester_id
     * @param string requester_type
     * @param string notifier_type_id
     * @param string request_comment
     * @return App\Models\Approval
     */
    public function storeApproval($requester_id, $requester_type, $notifier_type_id, $request_comment);
    /**
     * Creates a approval document.
     * 
     *
     * @param string approval_id
     * @param string documentable_id
     * @param string documentable_type
     * @return App\Models\ApprovalDocument
     */
    public function storeApprovalDocument($approval_id, $documentData);
    /**
     * Returns a approval query.
     * 
     *
     * @param string approval_id
     * @return mixed
     */
    public function approval($approval_id);
    /**
     * Returns a user approval.
     * 
     *
     * @param string approval_id
     * @return mixed
     */
    public function userApproval($approval_id);
}
