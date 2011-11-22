 var cmi = new Object();

//
// SCORM 1.3 API Implementation
//
function SCORMapi1_3() {
    // Standard Data Type Definition
    CMIString200 = '^.{0,200}$';
    CMIString250 = '^.{0,250}$';
    CMILangString250 = '^(\{lang=([a-zA-Z]{2,3}|i|x)(\-[a-zA-Z0-9\-]{2,8})?\})?([^\{].{0,250}$)?';
    CMIString1000 = '^.{0,1500}$';
    CMIString4000 = '^.{0,4000}$';
    CMILangString4000 = '^(\{lang=([a-zA-Z]{2,3}|i|x)(\-[a-zA-Z0-9\-]{2,8})?\})?([^\{].{0,4000}$)?';
    CMIString64000 = '^.{0,64000}$';
    CMILang = '^([a-zA-Z]{2,3}|i|x)(\-[a-zA-Z0-9\-]{2,8})?$|^$';
    CMITime = '^(19[7-9]{1}[0-9]{1}|20[0-2]{1}[0-9]{1}|203[0-8]{1})((-(0[1-9]{1}|1[0-2]{1}))((-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1}))(T([0-1]{1}[0-9]{1}|2[0-3]{1})((:[0-5]{1}[0-9]{1})((:[0-5]{1}[0-9]{1})((\\.[0-9]{1,2})((Z|([+|-]([0-1]{1}[0-9]{1}|2[0-3]{1})))(:[0-5]{1}[0-9]{1})?)?)?)?)?)?)?)?$';
    CMITimespan = '^P(\\d+Y)?(\\d+M)?(\\d+D)?(T(((\\d+H)(\\d+M)?(\\d+(\.\\d{1,2})?S)?)|((\\d+M)(\\d+(\.\\d{1,2})?S)?)|((\\d+(\.\\d{1,2})?S))))?$';
    CMIInteger = '^\\d+$';
    CMISInteger = '^-?([0-9]+)$';
    CMIDecimal = '^-?([0-9]{1,4})(\\.[0-9]{1,18})?$';
    CMIIdentifier = '^\\S{0,200}[a-zA-Z0-9]$';
    CMILongIdentifier = '^\\S{0,4000}[a-zA-Z0-9]$';
    CMIFeedback = CMIString200; // This must be redefined
    CMIIndex = '[._](\\d+).';
    CMIIndexStore = '.N(\\d+).';
    // Vocabulary Data Type Definition
    CMICStatus = '^completed$|^incomplete$|^not attempted$|^unknown$';
    CMISStatus = '^passed$|^failed$|^unknown$';
    CMIExit = '^time-out$|^suspend$|^logout$|^normal$|^$';
    CMIType = '^true-false$|^choice$|^(long-)?fill-in$|^matching$|^performance$|^sequencing$|^likert$|^numeric$|^other$';
    CMIResult = '^correct$|^incorrect$|^unanticipated$|^neutral$|^-?([0-9]{1,4})(\\.[0-9]{1,18})?$';
    NAVEvent = '^previous$|^continue$|^exit$|^exitAll$|^abandon$|^abandonAll$|^suspendAll$|^{target=\\S{0,200}[a-zA-Z0-9]}choice$';
    NAVBoolean = '^unknown$|^true$|^false$';
    NAVTarget = '^previous$|^continue$|^choice.{target=\\S{0,200}[a-zA-Z0-9]}$'
    // Children lists
    cmi_children = '_version, comments_from_learner, comments_from_lms, completion_status, credit, entry, exit, interactions, launch_data, learner_id, learner_name, learner_preference, location, max_time_allowed, mode, objectives, progress_measure, scaled_passing_score, score, session_time, success_status, suspend_data, time_limit_action, total_time';
    comments_children = 'comment, timestamp, location';
    score_children = 'max, raw, scaled, min';
    objectives_children = 'progress_measure, completion_status, success_status, description, score, id';
    student_data_children = 'mastery_score, max_time_allowed, time_limit_action';
    student_preference_children = 'audio_level, audio_captioning, delivery_speed, language';
    interactions_children = 'id, type, objectives, timestamp, correct_responses, weighting, learner_response, result, latency, description';
    // Data ranges
    scaled_range = '-1#1';
    audio_range = '0#*';
    speed_range = '0#*';
    text_range = '-1#1';
    progress_range = '0#1';
    // The SCORM 1.3 data model
    var datamodel =  {
        'cmi._children':{'defaultvalue':cmi_children, 'mod':'r'},
        'cmi._version':{'defaultvalue':'1.0', 'mod':'r'},
        'cmi.comments_from_learner._children':{'defaultvalue':comments_children, 'mod':'r'},
        'cmi.comments_from_learner._count':{'mod':'r', 'defaultvalue':'0'},
        'cmi.comments_from_learner.n.comment':{'format':CMILangString4000, 'mod':'rw'},
        'cmi.comments_from_learner.n.location':{'format':CMIString250, 'mod':'rw'},
        'cmi.comments_from_learner.n.timestamp':{'format':CMITime, 'mod':'rw'},
        'cmi.comments_from_lms._children':{'defaultvalue':comments_children, 'mod':'r'},
        'cmi.comments_from_lms._count':{'mod':'r', 'defaultvalue':'0'},
        'cmi.comments_from_lms.n.comment':{'format':CMILangString4000, 'mod':'r'},
        'cmi.comments_from_lms.n.location':{'format':CMIString250, 'mod':'r'},
        'cmi.comments_from_lms.n.timestamp':{'format':CMITime, 'mod':'r'},
        'cmi.completion_status':{'defaultvalue':, 'format':CMICStatus, 'mod':'rw'},
        'cmi.completion_threshold':{'defaultvalue':, 'mod':'r'},
        'cmi.credit':{'defaultvalue':, 'mod':'r'},
        'cmi.entry':{'defaultvalue':, 'mod':'r'},
        'cmi.exit':{'defaultvalue':, 'format':CMIExit, 'mod':'w'},
        'cmi.interactions._children':{'defaultvalue':interactions_children, 'mod':'r'},
        'cmi.interactions._count':{'mod':'r', 'defaultvalue':'0'},
        'cmi.interactions.n.id':{'pattern':CMIIndex, 'format':CMILongIdentifier, 'mod':'rw'},
        'cmi.interactions.n.type':{'pattern':CMIIndex, 'format':CMIType, 'mod':'rw'},
        'cmi.interactions.n.objectives._count':{'pattern':CMIIndex, 'mod':'r', 'defaultvalue':'0'},
        'cmi.interactions.n.objectives.n.id':{'pattern':CMIIndex, 'format':CMILongIdentifier, 'mod':'rw'},
        'cmi.interactions.n.timestamp':{'pattern':CMIIndex, 'format':CMITime, 'mod':'rw'},
        'cmi.interactions.n.correct_responses._count':{'defaultvalue':'0', 'pattern':CMIIndex, 'mod':'r'},
        'cmi.interactions.n.correct_responses.n.pattern':{'pattern':CMIIndex, 'format':CMIFeedback, 'mod':'rw'},
        'cmi.interactions.n.weighting':{'pattern':CMIIndex, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.interactions.n.learner_response':{'pattern':CMIIndex, 'format':CMIFeedback, 'mod':'rw'},
        'cmi.interactions.n.result':{'pattern':CMIIndex, 'format':CMIResult, 'mod':'rw'},
        'cmi.interactions.n.latency':{'pattern':CMIIndex, 'format':CMITimespan, 'mod':'rw'},
        'cmi.interactions.n.description':{'pattern':CMIIndex, 'format':CMILangString250, 'mod':'rw'},
        'cmi.launch_data':{'defaultvalue':, 'mod':'r'},
        'cmi.learner_id':{'defaultvalue':, 'mod':'r'},
        'cmi.learner_name':{'defaultvalue':, 'mod':'r'},
        'cmi.learner_preference._children':{'defaultvalue':student_preference_children, 'mod':'r'},
        'cmi.learner_preference.audio_level':{'defaultvalue':'1', 'format':CMIDecimal, 'range':audio_range, 'mod':'rw'},
        'cmi.learner_preference.language':{'defaultvalue':'', 'format':CMILang, 'mod':'rw'},
        'cmi.learner_preference.delivery_speed':{'defaultvalue':'1', 'format':CMIDecimal, 'range':speed_range, 'mod':'rw'},
        'cmi.learner_preference.audio_captioning':{'defaultvalue':'0', 'format':CMISInteger, 'range':text_range, 'mod':'rw'},
        'cmi.location':{'defaultvalue':, 'format':CMIString1000, 'mod':'rw'},
        'cmi.max_time_allowed':{'defaultvalue':, 'mod':'r'},
        'cmi.mode':{'defaultvalue':, 'mod':'r'},
        'cmi.objectives._children':{'defaultvalue':objectives_children, 'mod':'r'},
        'cmi.objectives._count':{'mod':'r', 'defaultvalue':'0'},
        'cmi.objectives.n.id':{'pattern':CMIIndex, 'format':CMILongIdentifier, 'mod':'rw'},
        'cmi.objectives.n.score._children':{'defaultvalue':score_children, 'pattern':CMIIndex, 'mod':'r'},
        'cmi.objectives.n.score.scaled':{'defaultvalue':null, 'pattern':CMIIndex, 'format':CMIDecimal, 'range':scaled_range, 'mod':'rw'},
        'cmi.objectives.n.score.raw':{'defaultvalue':null, 'pattern':CMIIndex, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.objectives.n.score.min':{'defaultvalue':null, 'pattern':CMIIndex, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.objectives.n.score.max':{'defaultvalue':null, 'pattern':CMIIndex, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.objectives.n.success_status':{'defaultvalue':'unknown', 'pattern':CMIIndex, 'format':CMISStatus, 'mod':'rw'},
        'cmi.objectives.n.completion_status':{'defaultvalue':'unknown', 'pattern':CMIIndex, 'format':CMICStatus, 'mod':'rw'},
        'cmi.objectives.n.progress_measure':{'defaultvalue':null, 'format':CMIDecimal, 'range':progress_range, 'mod':'rw'},
        'cmi.objectives.n.description':{'pattern':CMIIndex, 'format':CMILangString250, 'mod':'rw'},
        'cmi.progress_measure':{'defaultvalue':, 'format':CMIDecimal, 'range':progress_range, 'mod':'rw'},
        'cmi.scaled_passing_score':{'defaultvalue':, 'format':CMIDecimal, 'range':scaled_range, 'mod':'r'},
        'cmi.score._children':{'defaultvalue':score_children, 'mod':'r'},
        'cmi.score.scaled':{'defaultvalue':, 'format':CMIDecimal, 'range':scaled_range, 'mod':'rw'},
        'cmi.score.raw':{'defaultvalue':, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.score.min':{'defaultvalue':, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.score.max':{'defaultvalue':, 'format':CMIDecimal, 'mod':'rw'},
        'cmi.session_time':{'format':CMITimespan, 'mod':'w', 'defaultvalue':'PT0H0M0S'},
        'cmi.success_status':{'defaultvalue':, 'format':CMISStatus, 'mod':'rw'},
        'cmi.suspend_data':{'defaultvalue':, 'format':CMIString64000, 'mod':'rw'},
        'cmi.time_limit_action':{'defaultvalue':,'mod':'r'},
        'cmi.total_time':{'defaultvalue':, 'mod':'r'},
        'adl.nav.request':{'defaultvalue':'_none_', 'format':NAVEvent, 'mod':'rw'}
    };
    //
    // Datamodel inizialization
    //
//    var cmi = new Object();
        cmi.comments_from_learner = new Object();
        cmi.comments_from_learner._count = 0;
        cmi.comments_from_lms = new Object();
        cmi.comments_from_lms._count = 0;
        cmi.interactions = new Object();
        cmi.interactions._count = 0;
        cmi.learner_preference = new Object();
        cmi.objectives = new Object();
        cmi.objectives._count = 0;
        cmi.score = new Object();

    // Navigation Object
    var adl = new Object();
        adl.nav = new Object();

    for (element in datamodel) {
        if (element.match(/\.n\./) == null) {
            if ((typeof eval('datamodel["'+element+'"].defaultvalue')) != 'undefined') {
                eval(element+' = datamodel["'+element+'"].defaultvalue;');
            } else {
                eval(element+' = "";');
            }
        }
    }

   if (cmi.completion_status == '') {
        cmi.completion_status = 'not attempted';
    } 
    
    //
    // API Methods definition
    //

var API_1484_11 = new SCORMapi1_3();

var api = new SCORMapi1_3();
